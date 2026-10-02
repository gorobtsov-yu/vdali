<?php

namespace App\Http\Requests\Tests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestsRequest extends FormRequest
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
                'string',
                'max:150',
                'min:3',
            ],
            'code' => [
                'string',
                'max:150',
                'min:3',
                'unique:tests,code',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'results_count' => [
                'integer:strict',
                'min:1',
            ],
            'groups' => [
                'array',
            ],
            'groups.*.questions' => [
                'array',
            ],
            'groups.*.questions.*.text' => [
                'string',
                'min:3',
                'max:5000',
            ],
            'groups.*.questions.*.code' => [
                'string',
                'min:3',
                'max:150',
            ],
            'groups.*.questions.*.queue_position' => [
                'integer:strict',
                'min:1',
            ],
            'groups.*.questions.*.answers' => [
                'array',
            ],
            'groups.*.questions.*.answers.*.text' => [
                'string',
                'min:3',
                'max:5000',
            ],
            'groups.*.questions.*.answers.*.hash' => [
                'string',
            ],
        ];
    }
}
