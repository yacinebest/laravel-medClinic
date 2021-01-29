<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\PatientStoreRequest;
use App\Http\Requests\Patient\PatientUpdateRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\OrientationLetter;
use App\Models\Prescription;
use App\Models\Imagery;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PhpParser\Comment\Doc;
use Yajra\Datatables\DataTables;
use Illuminate\Support\Str;

class PatientController extends Controller
{


    public function __construct() {
        $this->middleware('doctor_or_secretary.auth',['except'=>['getPrescriptionsForPatient',
                                                                'getOrientationLettersForPatient',
                                                                'getImageriesForPatient',]]);

        $this->middleware('doctor.auth',['only'=>['getPrescriptionsForPatient',
                                                'getOrientationLettersForPatient',
                                                'getImageriesForPatient',]]);
    }

    //Ajax Request for other Controller to use
    public function getAllPatientForDropdown(){
        $array_patients['patients'] = Patient::orderby("last_name","asc")
            ->orderby("first_name","asc")
            ->orderby("birth_date","asc")
            ->select('id','last_name','first_name',"birth_date")
            ->get();

        return response()->json($array_patients);
    }
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patient.index');
    }
    //Ajax
    public function getAllPatient(Request $request){
        if ($request->ajax()) {
            $data = Patient::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function(Patient $patient)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                        ['id'=>$patient->id,'name_id'=>'patient',
                            'route_delete'=>'patient.destroy',
                            'route_edit'=>'patient.edit',
                            'route_show'=>'patient.show',])->render();
                })
                ->addColumn('email_limit',function(Patient $patient)
                {
                    return view('layouts.includes.tables.datatable.string_limit',
                        ['str'=>$patient->email])->render();
                })
                ->addColumn('address_limit',function(Patient $patient)
                {
                    return view('layouts.includes.tables.datatable.string_limit',
                        ['str'=>$patient->address])->render();
                })
                ->escapeColumns([])
                ->make(true);
        }
    }
    //End Ajax

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PatientStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $array_request = $this->processStoreRequest($request);
        $pat = Patient::create($array_request);
        $request->session()->flash('store_patient',$pat->last_name .' ' . $pat->first_name .' a été Ajouté a la liste des patients.');
        return redirect(route('patient.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        return view('patient.show',['patient'=>$patient]);
    }

    //Ajax
    public function getAppointmentsForPatient(Request $request){
        if ($request->ajax() && $request->has('patient_id')) {
            $patient = Patient::find($request['patient_id']);
            $data =  $patient->appointments()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('doctor_full_name',function(Appointment $appointment){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$appointment->doctor,'route_show'=>'doctor.show'])->render();
                })
                ->addColumn('action',function(Appointment $appointment)
                {
                    if ( (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id==$appointment->doctor->id)
                        || Auth::guard('secretary')->check() ){
                            return view('layouts.includes.crud.edit_show_delete_btn',
                                        ['id'=>$appointment->id,'name_id'=>'appointment',
                                        'route_delete'=>'appointment.destroy',
                                        'route_edit'=>'appointment.edit',])->render();
                    }else{
                        return ;
                    }
                })
                ->escapeColumns([])
                ->make(true);
        }
    }
    public function getPrescriptionsForPatient(Request $request)
    {
          if ($request->ajax() && $request->has('patient_id')) {
            $patient = Patient::find($request['patient_id']);
            $data =  $patient->prescriptions()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('doctor_full_name',function(Prescription $prescription){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$prescription->doctor,'route_show'=>'doctor.show'])->render();
                })
                ->addColumn('action',function(Prescription $prescription)
                {
                    if ( (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id==$prescription->doctor->id)){
                        return view('layouts.includes.crud.edit_show_delete_btn',
                                    ['id'=>$prescription->id,'name_id'=>'prescription',
                                    'route_delete'=>'prescription.destroy',
                                    'route_edit'=>'prescription.edit',])->render();
                    }else{
                        return ;
                    }
                })
                ->addColumn('details_url', function(Prescription $prescription) {
                    return route('prescription.ajax.getPrescriptionLines', ['prescription'=>$prescription->id]);
                })
                ->escapeColumns([])
                ->make(true);
        }
    }
    public function getOrientationLettersForPatient(Request $request)
    {
          if ($request->ajax()) {
            $patient = Patient::find($request['patient_id']);
            $data =  $patient->orientationLetters()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('content_preview',function(OrientationLetter $orientationLetter){
                    return Str::limit($orientationLetter->content, 30, '...');
                })
                ->addColumn('doctor_full_name',function(OrientationLetter $orientationLetter){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$orientationLetter->doctor,'route_show'=>'doctor.show'])->render();
                })
                ->addColumn('action',function(OrientationLetter $orientationLetter)
                {
                    if ( (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id==$orientationLetter->doctor->id)){
                        return view('layouts.includes.crud.edit_show_delete_btn',
                                    ['id'=>$orientationLetter->id,'name_id'=>'orientationletter',
                                    'route_delete'=>'orientationletter.destroy',
                                    'route_edit'=>'orientationletter.edit',])->render();
                    }else{
                        return ;
                    }
                })
                ->escapeColumns([])
                ->make(true);
        }
    }

    public function getImageriesForPatient(Request $request){
        if ($request->ajax() && $request->has('patient_id')) {
            $patient = Patient::find($request['patient_id']);
            $data =  $patient->imageries()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('file_path',function(Imagery $image){
                    return view('layouts.includes.tables.datatable.image',['path'=>asset('imageries/' . $image->file)])->render();
                })
                ->addColumn('action',function(Imagery $imagery)
                {
                    if ( (Auth::guard('doctor')->check())){
                        return view('layouts.includes.crud.edit_show_delete_btn',
                                ['id'=>$imagery->id,'name_id'=>'imagery',
                                'route_delete'=>'imagery.destroy',])->render();
                    }else{
                        return ;
                    }
                })
                ->escapeColumns([])
                ->make(true);
        }
    }
    //End Ajax

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patient.edit',['patient'=>$patient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PatientUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, $id)
    {
        $patient = Patient::find($id);

        $array_request = $this->processUpdateRequest($request);
        $patient->update($array_request);

        $request->session()->flash('update_patient',$patient->last_name .' ' . $patient->first_name .' a été Mise a Jour.');
        return redirect(route('patient.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient =Patient::findOrFail($id);

        $patient->appointments()->delete();
        $patient->orientationLetters()->delete();

        foreach ($patient->prescriptions as $prescription) {
            $prescription->prescriptionLines()->delete();
        }
        $patient->prescriptions()->delete();

        $patient->imageries()->delete();

        $patient->delete();
        session()->flash('destroy_patient','Un Patient a été supprimer.');
        return redirect(route('patient.index'));
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
    public function processStoreRequest(PatientStoreRequest $request)
    {
        $array_except= ['_token'];
        if($request['social_security_number']==null)
            array_push($array_except,'social_security_number');
        return $request->except($array_except);
    }

     /**
     * Process the Update Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processUpdateRequest(PatientUpdateRequest $request)
    {

        $array_except= ['_token'];
        if($request['social_security_number']==null)
            $request['social_security_number']='';
        return $request->except($array_except);
    }
}
