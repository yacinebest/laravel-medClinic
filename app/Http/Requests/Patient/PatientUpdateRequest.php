<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'required',
            'last_name'=>'required',
            'birth_date'=>'required|date',
            'phone_number'=>'required|min:10',
            'address'=>'required',
            'email'=>'required|email',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Le Prénom est obligatoire.',
            'last_name.required' => 'Le Nom est obligatoire.',
            'birth_date.required' => 'La date de naissance est obligatoire.',
            'birth_date.date' => 'La date de naissance n\'est pas valide.',
            'address.required' => 'address est obligatoire.',
            'phone_number.required' => 'Le numero de telephone est obligatoire.',
            'phone_number.min' => 'Le numero de telephone est invalide.',
            'email.required' => 'L\'Adresse E-mail est obligatoire.',
            'email.email' => 'L`\'Adresse E-mail n\'est pas valide.',
        ];
    }
}
