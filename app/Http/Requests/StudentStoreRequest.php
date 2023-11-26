<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'course_id' => ['required', 'exists:courses,id'],
            'matric_no' => ['required', 'max:255', 'string'],
            'year' => ['required', 'max:255'],
            'semester' => ['required', 'max:255'],
        ];
    }
}
