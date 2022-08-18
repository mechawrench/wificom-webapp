<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendDigiromRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->tokenCan('applications_access')) {
            return true;
        }

        if (auth()->user()->tokenCan('third_party_applications_access')) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'device_uuid' => 'required|string|size:16',
            'application_uuid' => 'required|string|size:16',
            'comment' => 'nullable|string|max:255',
            'digirom' => 'required|string|regex:/^[vV][1-2](-([0-9A-Fa-f@]{4,5})){1,10}$/',
        ];
    }
}
