<?php

namespace App\Http\Requests\CalendarEvent;

use Illuminate\Foundation\Http\FormRequest;

class CalendarEventStoreRequest extends FormRequest
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
            'title' => [
                'required',
                'string'
            ],
            'content' => [
                'nullable',
                'string'
            ],
            'start' => [
                'required',
                'date_format:Y-m-d\TH:i:s\Z'
            ],
            'end' => [
                'required',
                'date_format:Y-m-d\TH:i:s\Z'
            ],
            'is_absent' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
