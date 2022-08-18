<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->tokenCan('device_access')) {
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
            'last_output' => 'nullable|string',
        ];
    }
}
