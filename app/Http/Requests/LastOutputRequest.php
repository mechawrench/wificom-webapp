<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LastOutputRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
    public function rules(): array
    {
        return [
            'application_uuid' => 'required|string|size:16',
            'device_uuid' => 'required|string|size:16',
        ];
    }
}
