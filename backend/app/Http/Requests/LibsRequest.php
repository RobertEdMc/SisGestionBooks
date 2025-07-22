<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibsRequest extends FormRequest
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
                'title'  => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'author_id' => 'required|exists:authors,id',
            ];
        }

        if ($method === 'PUT' || $method === 'PATCH') {
            return [
                'title'  => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'author_id' => 'required|exists:authors,id',
            ];
        }

        return [];
    }
}
