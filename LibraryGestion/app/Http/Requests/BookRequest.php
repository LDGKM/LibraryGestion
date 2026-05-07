<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'titre'=>'required|string|min:3|max:255',
        'description'=>'required|string|min:3|max:255',
        'annee_de_publication'=>'required|date_format:Y|before_or_equal:'.date('Y'),
        'isbn'=>'required|string|min:13|size:13',
        'nb_exemp'=>'required|integer|min:1|max:100',
        'image'=>'required|string|min:3|max:255'
        ];
    }
}
