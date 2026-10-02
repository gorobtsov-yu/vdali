<?php

namespace App\Http\Requests\Tests\Associative;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssociativeTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '*' => 'boolean',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $data = $this->all();

            if (! is_array($data)) {
                $validator->errors()->add('body', 'Provided data must be an array');

                return;
            }

            if (empty($data)) {
                $validator->errors()->add('body', 'Empty request');

                return;
            }

            foreach ($data as $key => $value) {
                if (! is_string($key)) {
                    $validator->errors()->add('body', 'The key values must be strings');

                    return;
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            '*.boolean' => 'Only boolean values allowed',
        ];
    }
}
