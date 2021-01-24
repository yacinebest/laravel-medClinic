<?php

namespace App\Http\Requests\Prescription;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionUpdateRequest extends FormRequest
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
        ];
    }
}
