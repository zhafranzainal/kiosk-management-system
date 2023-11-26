<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintUpdateRequest extends FormRequest
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
            'kiosk_participant_id' => [
                'required',
                'exists:kiosk_participants,id',
            ],
            'user_id' => ['nullable', 'exists:users,id'],
            'description' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:pending,in progress,completed'],
        ];
    }
}
