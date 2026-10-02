<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
            'first_name' => [
                'max:255',
            ],
            'last_name' => [
                'max:255',
            ],
            'middle_name' => [
                'max:255',
                'nullable',
            ],
            'login' => [
                'max:32',
                'unique:users,login',
            ],
            'email' => [
                'email',
                'nullable',
                'unique:users,email',
            ],
            'desired_salary' => [
                'integer:strict',
                'nullable',
            ],
            'password' => [
                'max:255',
            ],
            'password_repeat' => [
                'max:255',
                'same:password',
            ],
        ];
    }
}
