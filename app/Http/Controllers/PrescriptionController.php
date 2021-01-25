<?php

namespace App\Http\Controllers;

use App\Http\Requests\Prescription\PrescriptionStoreRequest;
use App\Http\Requests\Prescription\PrescriptionUpdateRequest;
use App\Models\Prescription;
use App\Models\PrescriptionLine;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class PrescriptionController extends Controller
{

    public function __construct() {
        $this->middleware('doctor.auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->has('patient'))
            return view('prescription.create',['patient'=>$request['patient'],'time_taken_const'=>PrescriptionLine::getTimeTakenConst() ]  );
        else
            return view('prescription.create',['time_taken_const'=>PrescriptionLine::getTimeTakenConst() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrescriptionStoreRequest $request)
    {
        if($this->isValidationForPrescriptionLinesPassed($request)){

            $array_request = $this->processStoreRequestForPrescription($request);
            $prescription = Prescription::create($array_request);

            $array_request_pre_lines= $this->processStoreRequestForPrescriptionLines($request);
            for ($i=0; $i < count($array_request_pre_lines['medicine']); $i++) {
                PrescriptionLine::create([
                    'medicine'=>$array_request_pre_lines['medicine'][$i],
                    'dose'=>$array_request_pre_lines['dose'][$i],
                    'time_taken'=>$array_request_pre_lines['time_taken'][$i],
                    'duration'=>$array_request_pre_lines['duration'][$i],
                    'prescription_id'=>$prescription->id]);
            }

            $request->session()->flash('store_prescription','Vous avez crée une prescription pour Le Patient '
                .$prescription->patient->last_name . ' ' .$prescription->patient->first_name . '.');
            return redirect(route('patient.show',$prescription->patient->id));
        }
        else{
            return redirect(route('prescription.create'))->withErrors(["prescriptionLines"=>
            "Veuillez remplir tous les champs pour les Lignes de Prescription."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);
        return view('prescription.edit',['prescription'=>$prescription,'time_taken_const'=>PrescriptionLine::getTimeTakenConst()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrescriptionUpdateRequest $request, $id)
    {
        $prescription = Prescription::find($id);
        if($this->isValidationForUpdatePrescriptionLinesPassed($request)){
            $array_request = $this->processUpdateRequestForPrescription($request);
            $prescription->update($array_request);

            //for update line already present
            $array_request_pre_lines= $this->processUpdateRequestForPrescriptionLines($request);
            for ($i=0; $i < $prescription->prescriptionLines->count(); $i++) {
                $prescription->prescriptionLines[$i]->update([
                    'medicine'=>$array_request_pre_lines['pmedicine'][$i],
                    'dose'=>$array_request_pre_lines['pdose'][$i],
                    'time_taken'=>$array_request_pre_lines['ptime_taken'][$i],
                    'duration'=>$array_request_pre_lines['pduration'][$i]
                    ]);
                $prescription->save();
            }

             //for adding new line
            if($request->has('medicine')){
                $array_request_pre_lines= $this->processStoreRequestForPrescriptionLines($request);
                for ($i=0; $i < count($array_request_pre_lines['medicine']); $i++) {
                    PrescriptionLine::create([
                        'medicine'=>$array_request_pre_lines['medicine'][$i],
                        'dose'=>$array_request_pre_lines['dose'][$i],
                        'time_taken'=>$array_request_pre_lines['time_taken'][$i],
                        'duration'=>$array_request_pre_lines['duration'][$i],
                        'prescription_id'=>$prescription->id]);
                }
            }


            $request->session()->flash('update_prescription',
            'Vous avez Mis A jour une prescription pour Le Patient '
            .$prescription->patient->last_name . ' ' .$prescription->patient->first_name . '.');
        }else{
            return redirect(route('prescription.edit',['prescription'=>$prescription]))->withErrors(["prescriptionLines"=>
            "Veuillez remplir tous les champs pour les Lignes de Prescription."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p =Prescription::findOrFail($id);
        $p->prescriptionLines()->delete();
        $p->delete();
        session()->flash('destroy_prescription','Une Prescription a été supprimer.');
        return redirect()->back();
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPrescriptionLine($id)
    {
        $p_line = PrescriptionLine::findOrFail($id);
        $p = $p_line->prescription;
        if($p->prescriptionLines->count()>1){
            $p_line->delete();
            session()->flash('destroy_prescriptionLine','Une Ligne de Cette Prescription a été supprimer.');
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(["prescriptionLines_atleast"=>
            "La Prescription doit avoir au moins 1 ligne."]);
        }
    }


     /*
    |---------------------------------------------------------------------------|
    | CUSTOM FUNCTION                                                           |
    |---------------------------------------------------------------------------|
    */

    /**
     * Process the Store Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processStoreRequestForPrescription(PrescriptionStoreRequest $request)
    {
        $array_except= ['_token'];

        $array_except2= ['medicine','dose','time_taken','duration'];

        $array_except = array_merge($array_except,$array_except2);

        return $request->except($array_except);
    }
    /**
     * Process the Store Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processStoreRequestForPrescriptionLines(Request $request)
    {
        $array_except= ['_token','date','patient_id','doctor_id'];

        return $request->except($array_except);
    }

    public function isValidationForPrescriptionLinesPassed(Request $request)
    {
        for ($i=0; $i <count($request['medicine']) ; $i++) {
            if($request['medicine'][$i]==null ||
                $request['dose'][$i]==null ||
                $request['time_taken'][$i]==null ||
                $request['duration'][$i]==null){
                return false;
            }
        }
        return true;
    }


    /**
     * Process the Store Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processUpdateRequestForPrescription(PrescriptionUpdateRequest $request)
    {
        $array_except= ['_token'];

        $array_except2= ['medicine','dose','time_taken','duration'];

        $array_except = array_merge($array_except,$array_except2);

        return $request->except($array_except);
    }
     /**
     * Process the Store Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processUpdateRequestForPrescriptionLines(Request $request)
    {
        $array_except= ['_token','date','patient_id','doctor_id'];

        return $request->except($array_except);
    }

    public function isValidationForUpdatePrescriptionLinesPassed(Request $request)
    {
        for ($i=0; $i <count($request['pmedicine']) ; $i++) {
            if($request['pmedicine'][$i]==null ||
                $request['pdose'][$i]==null ||
                $request['ptime_taken'][$i]==null ||
                $request['pduration'][$i]==null){
                return false;
            }
        }

        if($request->has('medicine'))
            return $this->isValidationForPrescriptionLinesPassed($request);
        else
            return true;
    }
}
