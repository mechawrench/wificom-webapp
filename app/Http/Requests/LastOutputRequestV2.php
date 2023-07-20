<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LastOutputRequestV2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
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
            'device_name' => 'required|string',
        ];
    }
}
