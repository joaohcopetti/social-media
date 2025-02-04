<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'description' => ['nullable', 'string', 'max:1000'],
            'photo' => [!$isEdit ? 'required' : 'nullable', 'file', 'mimes:jpeg,jpg,png', 'max:1024']
        ];
    }
}
