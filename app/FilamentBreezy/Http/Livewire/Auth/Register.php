<?php

namespace App\FilamentBreezy\Http\Livewire\Auth;

use Clarkeash\Doorman\Doorman;
use Clarkeash\Doorman\Exceptions\DoormanException;
use Clarkeash\Doorman\Validation\DoormanRule;
use Filament\Facades\Filament;
use Filament\Forms;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use JeffGreco13\FilamentBreezy\FilamentBreezy;
use JeffGreco13\FilamentBreezy\Http\Livewire\Auth\Register as FilamentBreezyRegister;

class Register extends FilamentBreezyRegister
{
    use Forms\Concerns\InteractsWithForms;

    public $name;

    public $email;

    public $password;

    public $password_confirm;

    public $invite_code;

    public $consent_to_terms;

    public function mount()
    {
        if (Filament::auth()->check()) {
            return redirect(config('filament.home_url'));
        }
    }

    public function messages(): array
    {
        return [
            'email.unique' => __('filament-breezy::default.registration.notification_unique'),
        ];
    }

    protected function getFormSchema(): array
    {
        $fields = [];
//        if(env('REQUIRE_INVITE') == true){
//            // append to $fields array
//            array_add($fields, [[Forms\Components\TextInput::make('invite_code')
//                ->label(__('Invitation Code'))
//                ->required()
//                ->rules([new DoormanRule($this->email)])]]);
//        }

        array_add($fields, [
            Forms\Components\TextInput::make('name')
                ->label(__('filament-breezy::default.fields.name'))
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label(__('filament-breezy::default.fields.email'))
                ->required()
                ->email()
                ->unique(table: config('filament-breezy.user_model')),
            Forms\Components\TextInput::make('password')
                ->label(__('filament-breezy::default.fields.password'))
                ->required()
                ->password()
                ->rules(app(FilamentBreezy::class)->getPasswordRules()),
            Forms\Components\TextInput::make('password_confirm')
                ->label(__('filament-breezy::default.fields.password_confirm'))
                ->required()
                ->password()
                ->same('password'),
            Forms\Components\Checkbox::make('consent_to_terms')
                ->label('I consent to the terms of service and privacy policy.')
                ->required(),
        ]);

        return $fields;
    }

    protected function prepareModelData($data): array
    {
        $preparedData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'invite_code' => $data['invite_code'],
            'consent_to_terms' => $this->consent_to_terms,
        ];

        return $preparedData;
    }

    public function register()
    {
        $preparedData = $this->prepareModelData($this->form->getState());

        $user = config('filament-breezy.user_model')::create($preparedData);

        // Redeem the invitation code
        if (env('REQUIRE_INVITE') == true) {
            try {
                Doorman::redeem($this->invite_code, $this->email);
            } catch (DoormanException $e) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
        }

        event(new Registered($user));
        Filament::auth()->login($user, true);

        return redirect()->to(config('filament-breezy.registration_redirect_url'));
    }

    public function render(): View
    {
        $view = view('filament-breezy::register');

        $view->layout('filament::components.layouts.base', [
            'title' => __('filament-breezy::default.registration.title'),
        ]);

        return $view;
    }
}
