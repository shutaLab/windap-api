<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [
                'string',
                'required',
                'max:255',

            ],
            "grade" => [
                'integer',
                'required',
            ],
            "sail_no" => [
                'string',
                'required',
                'max:255',
            ],
            "introduction" => [
                'string',
                'nullable',
                'max:255',
            ],
            "profile_image" => [
                'string',
                'nullable'
            ]
        ];
    }
}
