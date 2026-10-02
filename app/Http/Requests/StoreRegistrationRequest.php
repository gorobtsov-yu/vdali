<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'login' => ['required', 'string', 'min:3', 'max:32', 'regex:/^[a-zA-Z0-9_.-]+$/', Rule::unique('users', 'login'), Rule::unique('registration_requests', 'login')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email'), Rule::unique('registration_requests', 'email')],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Эта почта уже зарегистрирована или заявка с ней уже подана.',
            'login.unique' => 'Логин занят или заявка с ним уже подана.',
            'login.regex' => 'Логин: латиница, цифры, символы _ . -',
        ];
    }
}
