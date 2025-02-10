<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PanelProfileRequest extends FormRequest
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

        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'description' => ['nullable', 'string', 'max:1000'],
            'photo' => [!$isEdit ? 'required' : 'nullable', 'file', 'mimes:jpeg,jpg,png', 'max:1024'],
            'is_user' => ['required', 'boolean'],
            'facebook' => ['nullable', 'url', 'regex:/facebook.com/'],
            'instagram' => ['nullable', 'url', 'regex:/instagram.com/'],
            'x' => ['nullable', 'url', 'regex:/x.com/'],
            'tiktok' => ['nullable', 'url', 'regex:/tiktok.com/'],
            'youtube' => ['nullable', 'url', 'regex:/youtube.com/'],
            'email' => [
                'required_if_accepted:is_user',
                'nullable',
                'email',
                Rule::unique('users', 'email')
            ],
            'password' => [
                'required_if_accepted:is_user',
                'nullable',
                'min:6',
                'confirmed'
            ],
            'password_confirmation' => [
                'required_if_accepted:is_user',
                'nullable',
                'min:6'
            ]
        ];
    }
}
