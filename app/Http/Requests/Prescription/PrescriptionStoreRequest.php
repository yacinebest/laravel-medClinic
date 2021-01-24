<?php

namespace App\Http\Requests\Prescription;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionStoreRequest extends FormRequest
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
            'date'=>'required',
            'patient_id'=>'required',
            'doctor_id' => 'required',

            "medicine"  => "required|array",
            "dose"  => "required|array",
            "time_taken"  => "required|array",
            "duration"  => "required|array",
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
            'date.required' => 'La Date est obligatoire.',
            'patient_id.required' => 'Le Patient conserné est obligatoire.',
            'doctor_id.required' => 'Le Docteur responsble est obligatoire.',

            "medicine.required"  => "Vous devez passer la liste des Médicament.",
            "dose.required"  => "Vous devez passer la liste des Dose de chaque Médicament.",
            "time_taken.required"  => "Vous devez passer la liste des Moment de prise de chaque Médicament.",
            "duration.required"  => "Vous devez passer la liste des durée de traitement de chaque Médicament.",
        ];
    }
}
