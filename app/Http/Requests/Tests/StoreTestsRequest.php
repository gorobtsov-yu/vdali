<?php

namespace App\Http\Requests\Tests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestsRequest extends FormRequest
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
                'string',
                'max:150',
                'min:3',
            ],
            'code' => [
                'required',
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
                'required',
                'integer:strict',
                'min:1',
            ],
            'groups' => [
                'required',
                'array',
            ],
            'groups.*.questions' => [
                'required',
                'array',
            ],
            'groups.*.questions.*.text' => [
                'required',
                'string',
                'min:3',
                'max:5000',
            ],
            'groups.*.questions.*.code' => [
                'required',
                'string',
                'min:3',
                'max:150',
            ],
            'groups.*.questions.*.queue_position' => [
                'required',
                'integer:strict',
                'min:1',
            ],
            'groups.*.questions.*.answers' => [
                'required',
                'array',
            ],
            'groups.*.questions.*.answers.*.text' => [
                'required',
                'string',
                'min:3',
                'max:5000',
            ],
            'groups.*.questions.*.answers.*.hash' => [
                'required',
                'string',
            ],
        ];
    }
}
