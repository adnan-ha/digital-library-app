<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:50',
            'description' => 'required|string',
            'file' => 'sometimes|mimes:pdf|max:20480',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:10240',
            'category' => 'required|exists:categories,id',
        ];
    }
}
