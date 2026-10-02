<?php

namespace App\Http\Requests\Vacancies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacanciesRequest extends FormRequest
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
                'string',
                'max:150',
                'min:3',
            ],
            'description' => [
                'string',
                'max:5000',
                'min:3',
            ],
            'salary' => [
                'integer:strict',
                'min:10000',
            ],
            'contact' => [
                'string',
                'max:150',
                'min:3',
            ],
        ];
    }
}
