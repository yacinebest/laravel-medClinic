<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientStoreRequest extends FormRequest
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
            'birth_date'=>'required',
            'phone_number'=>'min:10|required',
            'address'=>'required',
            'email'=>'required|email|unique:patients',
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
            'address.required' => 'address est obligatoire.',
            'phone_number.required' => 'Le numero de telephone est obligatoire.',
            'phone_number.min' => 'Le numero de télephone est invalide.',
            'email.required' => 'L\'Adresse E-mail est obligatoire.',
            'email.unique' => 'Cette Adresse E-mail est déjà utilisée!',
            'email.email' => 'L`\'Adresse E-mail n\'est pas valide.',
        ];
    }
}
