<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
        $method = $this->method();

        if ($method === 'POST') {
            return [
                'name'  => 'required|string|max:255',
                'email' => 'nullable|email|unique:authors,email',
            ];
        }

        if ($method === 'PUT' || $method === 'PATCH') {
            return [
                'name'  => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:authors,email,' . $this->route('id'),
            ];
        }

        return [];
    }
}
