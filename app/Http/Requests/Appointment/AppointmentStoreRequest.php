<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
            'date'=>'required|date',
            'start_at'=>'required|date_format:H:i',
            'end_at'=>'required|date_format:H:i|after:start_at',
            'patient_id'=>'required',
            'doctor_id' => 'required',
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
            'date.date' => 'La date n\'est pas valide.',

            'start_at.required' => 'L\'Heure de début du Rendez-vous  est obligatoire.',
            'start_at.date_format'=>'Commence A n\'est pas valide.',

            'end_at.required' => 'L\'Heure de fin du Rendez-vous  est obligatoire.',
            'end_at.date_format'=>'Fini A n\'est pas valide.',
            'end_at.after'=>'Fini A doit être un temp après le Commence à.',

            'patient_id.required' => 'Le Patient conserné est obligatoire.',
            'doctor_id.required' => 'Le Docteur responsble est obligatoire.',
        ];
    }
}
