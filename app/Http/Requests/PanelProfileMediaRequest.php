<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PanelProfileMediaRequest extends FormRequest
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
        $size = Str::contains($this->file('file')->getMimeType(), 'video')
            ? '1024000'
            : '4096';

        return [
            'file' => ['required', 'file', 'mimes:png,jpg,jpeg,mp4', "max:$size"]
        ];
    }
}
