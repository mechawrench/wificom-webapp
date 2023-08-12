<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendDigiromRequestV2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'device_name' => 'required|string',
            'application_uuid' => 'required|string|size:16',
            'comment' => 'nullable|string|max:255',
            'digirom' => 'required|string',
        ];
    }
}
