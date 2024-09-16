<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string'
            ],
            'grade' => [
                'required',
                'integer'
            ],
            'sail_no' => [
                'required',
                'string'
            ],
            'introduction' => [
                'nullable',
                'string'
            ],
            'profile_image' => [
                'nullable',
                'string'
            ],

        ];
    }
}
