<?php

namespace App\Http\Requests\Departure;

use Illuminate\Foundation\Http\FormRequest;

class DepartureUpdateRequest extends FormRequest
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
            'intra_user_id' => [
                'nullable',
                'integer'
            ],
            'start' => [
                'required',
                'date'
            ],
            'end' => [
                'required',
                'date'
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
