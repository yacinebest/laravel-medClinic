<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\PatientStoreRequest;
use App\Http\Requests\Patient\PatientUpdateRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\OrientationLetter;
use App\Models\Prescription;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PhpParser\Comment\Doc;
use Yajra\Datatables\DataTables;

class PatientController extends Controller
{

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
        //
    }

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
        Patient::findOrFail($id)->delete();
        session()->flash('destroy_patient','Un Patient a été supprimer.');
        return redirect(route('patient.index'));
    }

    /**
     * Show the Profile Of Auth Patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('patient.profile');
    }


    //Ajax
     //Ajax Request for other Controller to use
     public function getAllPatientForDropdown(){
        $array_patients['patients'] = Patient::orderby("last_name","asc")
            ->orderby("first_name","asc")
            ->select('id','last_name','first_name')
            ->get();

        return response()->json($array_patients);
    }
    //

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
