<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationRequest extends FormRequest
{
    /**
     * Mapping between form request fields and corresponding model columns.
     */
    public array $mapFields = [
        'email' => 'email',
        'password' => 'password',
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'password' => Hash::make($this->input('password')),
            'verifiedToken' => Str::random(64),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email:filter', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.string' => 'Email must be string',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already registered',

            'password.required' => 'Password is required',
            'password.string' => 'Password must be string',
            'password.min' => 'Password min 8 characters',
        ];
    }
}
