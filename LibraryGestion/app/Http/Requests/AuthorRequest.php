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
        return [
            'first_name'=> 'required|string|min:3|max:255',
            'last_name'=> 'required|string|min:3|max:255',
            'bio'=> 'required|string|min:3',
            'birth_date'=> 'required|date|before:today',
            'death_date'=> 'required|date|before:today',
            'nationalite'=> 'required|string|min:3|max:255',
            'photo_path'=> 'required|string|min:3|max:255'
        ];
    }
}
