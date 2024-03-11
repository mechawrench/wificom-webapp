<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendDigiromRequestV2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'device_name' => 'required|string',
            'application_uuid' => 'required|string|size:16',
            'comment' => 'nullable|string|max:255',
            'digirom' => 'required|string|max:700',
        ];
    }
}
