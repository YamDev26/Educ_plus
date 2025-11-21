<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudent extends FormRequest
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
            // Informations Relatives Pour parent en charge des etudes
            'parent' => 'required|string',
            'phon1' => 'required|numeric|size:10|unique:parent_stds,phon1',
            'phon2' => 'nullable|numeric|size:10|unique:parent_stds,phon2',
            'nameFirstParent' => 'required|string',
            'nameLastParent' => 'nullable|string',
            'profesionParent' => 'nullable|string',
            'email' => 'nullable|email|unique:parent_stds,email',

            // Informations Relatives Pour eleve
            'matricule' => 'required|string|size:9|unique:students,matricule',
            'genre' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'dateNaiss' => 'required|date',
            'lieuNaiss' => 'required|string',
            'nationalite' => 'required|string',
            'extrait' => 'nullable|string',
            'residence' => 'required|string',
            'fille' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // Informations Relatives Aux Parents biologiques
            'pereNameFirst' => 'nullable|string',
            'pereNameLast' => 'nullable|string',
            'profPere' => 'nullable|string',
            'phonPere' => 'nullable|numeric|size:10',
            'mereNameFirst' => 'nullable|string',
            'mereNameLast' => 'nullable|string',
            'profMere' => 'nullable|string',
            'phonMere' => 'nullable|numeric|size:10',

            // Informations Relative Aux programmes de la rentree
            'oldSchool' => 'nullable|string',
            'oldLevel' => 'nullable|string',
            'affecte' => 'required|string',
            'doublant' => 'required|string',
            'boursier' => 'required|string',
            'interne' => 'nullable|string',
            'classe' => 'required|integer',
            'lv2' => 'nullable|string',
        ];
    }
}
