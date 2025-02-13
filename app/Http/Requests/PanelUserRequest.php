<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PanelUserRequest extends FormRequest
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
        $isEdit = $this->getMethod() === 'PATCH';
        $user = $isEdit ? $this->user : null;

        return [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => [
                'required',
                'email',
                !$isEdit
                ? Rule::unique('users', 'email')
                : Rule::unique('users', 'email')->ignore($user->id, 'id')
            ],
            'password' => [!$isEdit ? 'required' : 'nullable', 'confirmed', 'min:5'],
            'password_confirmation' => [!$isEdit ? 'required' : 'nullable'],
        ];
    }
}
