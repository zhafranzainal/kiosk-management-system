<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KioskStoreRequest extends FormRequest
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
            'business_type_id' => ['required', 'exists:business_types,id'],
            'name' => ['required', 'max:255', 'string'],
            'location' => ['required', 'max:255', 'string'],
            'suggested_action' => [
                'nullable',
                'in:no action,terminate,suspend,reassign',
            ],
            'comment' => ['nullable', 'max:255', 'string'],
            'status' => ['required', 'in:inactive,active,warning,repair'],
        ];
    }
}
