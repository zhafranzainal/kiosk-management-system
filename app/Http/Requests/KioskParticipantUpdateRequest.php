<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KioskParticipantUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'kiosk_id' => ['required', 'exists:kiosks,id'],
            'bank_id' => ['nullable', 'exists:banks,id'],
            'account_no' => ['nullable', 'max:255', 'string'],
        ];
    }
}
