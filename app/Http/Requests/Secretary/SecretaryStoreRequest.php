<?php

namespace App\Http\Requests\Secretary;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SecretaryStoreRequest extends FormRequest
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
            'username'=>'required|unique:secretaries',
            'email'=>'required|email|unique:secretaries',
            'password' => 'min:6|required|confirmed',
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
            'username.required' => 'Le Username est obligatoire.',
            'email.required' => 'L\'Adresse E-mail est obligatoire.',
            'password.required' => 'Le Mot de passe est obligatoire.',

            'username.unique' => 'Ce Username est déjà utilisée!',
            'email.unique' => 'Cette Adresse E-mail est déjà utilisée!',

            'password.min' => 'Le Mot de passe doit avoir plus de 6 caractéres.',

            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas..',

            'email.email' => 'L`\'Adresse E-mail n\'est pas valide.',
        ];
    }
}
