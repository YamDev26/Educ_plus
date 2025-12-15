<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
            "codeSchool" => 'required|string|max:255',
            "nomSchool" => 'required|string|max:255',
            "nomAbrege" => 'nullable|string|max:255',
            "statut" => 'required|string|max:255',
            "college" => 'nullable|string|max:255',
            "lycee" => 'nullable|string|max:255',
            "drenSchool" => 'required|string|max:255',
            "villeSchool" => 'required|string|max:255',
            "boitePostale" => 'nullable|string|max:255',
            "emailSchool" => 'required|email',
            "numSchool" => 'required|string|max:255',
            "create" => 'required|string|max:255',
            "ouverture" => 'nullable|string|max:255',
            "paiement" => 'required|string|max:255',
            "informatik" => 'required|string|max:255',
            "autres" => 'required|string|max:255',
            "fichier" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
