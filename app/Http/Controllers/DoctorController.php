<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctor\DoctorStoreRequest;
use App\Http\Requests\Doctor\DoctorUpdateRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\OrientationLetter;
use App\Models\Prescription;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Comment\Doc;
use Yajra\Datatables\DataTables;

class DoctorController extends Controller
{

    public function __construct() {
        $this->middleware('doctor_or_secretary.auth',['only'=>['show'
                                                    ,'getAppointmentsForDoctor'
                                                    ,'getPrescriptionsForDoctor'
                                                    ,'getOrientationLettersForDoctor'
                                                    ,'getAllDoctorForDropdown']]);
        $this->middleware('doctor.auth',['except'=>['show'
                                                    ,'getAppointmentsForDoctor'
                                                    ,'getPrescriptionsForDoctor'
                                                    ,'getOrientationLettersForDoctor'
                                                    ,'getAllDoctorForDropdown']]);
        $this->middleware('admin.auth', ['except' => ['home','profile','show'
                                                    ,'getAppointmentsForDoctor'
                                                    ,'getPrescriptionsForDoctor'
                                                    ,'getOrientationLettersForDoctor'
                                                    ,'getAllDoctorForDropdown']]);
    }

    /**
     * Display a dome page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('doctor.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctor.index');
    }
    //Ajax
    public function getAllDoctor(Request $request){
        if ($request->ajax()) {
            $data = Doctor::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function(Doctor $doctor)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                        ['id'=>$doctor->id,'name_id'=>'doctor',
                            'route_delete'=>'doctor.destroy',
                            'route_edit'=>'doctor.edit',
                            'route_show'=>'doctor.show',])->render();
                })
                ->addColumn('role_name',function(Doctor $doctor)
                {
                    return view('doctor.includes.datatable.role_spans',['doctor'=>$doctor,])->render();
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
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Doctor\DoctorStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorStoreRequest $request)
    {
        $array_request = $this->processStoreRequest($request);
        $doc = Doctor::create($array_request);
        $request->session()->flash('store_doctor',$doc->last_name .' ' . $doc->first_name .' a été Ajouté a la liste des médecin.');
        return redirect(route('doctor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);
        return view('doctor.show',['doctor'=>$doctor]);
    }
    //Ajax
    public function getAppointmentsForDoctor(Request $request){
        if ($request->ajax() && $request->has('doctor_id')) {
            $doctor = Doctor::find($request['doctor_id']);
            $data =  $doctor->appointments()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('patient_full_name',function(Appointment $appointment){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$appointment->patient])->render();
                })
                ->addColumn('action',function(Appointment $appointment)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                        ['id'=>$appointment->id,'name_id'=>'appointment',
                        'route_delete'=>'appointment.destroy',
                        'route_edit'=>'appointment.edit',])->render();
                })
                ->escapeColumns([])
                ->make(true);
        }
    }
    public function getPrescriptionsForDoctor(Request $request)
    {
          if ($request->ajax() && $request->has('doctor_id')) {
            $doctor = Doctor::find($request['doctor_id']);
            $data =  $doctor->prescriptions()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('patient_full_name',function(Prescription $prescription){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$prescription->patient])->render();
                })
                ->addColumn('action',function(Prescription $prescription)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                                    ['id'=>$prescription->id,'name_id'=>'prescription',
                                    'route_delete'=>'prescription.destroy',
                                    'route_edit'=>'prescription.edit',])->render();
                })
                ->escapeColumns([])
                ->make(true);
        }
    }
    public function getOrientationLettersForDoctor(Request $request)
    {
          if ($request->ajax()) {
            $doctor = Doctor::find($request['doctor_id']);
            $data =  $doctor->orientationLetters()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('content_preview',function(OrientationLetter $orientationLetter){
                    return Str::limit($orientationLetter->content, 30, '...');
                })
                ->addColumn('patient_full_name',function(OrientationLetter $orientationLetter){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$orientationLetter->patient])->render();
                })
                ->addColumn('action',function(OrientationLetter $orientationLetter)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                            ['id'=>$orientationLetter->id,'name_id'=>'orientationLetter',
                                // 'route_delete'=>'orientationletter.destroy',
                                // 'route_edit'=>'orientationletter.edit',
                                // 'route_show'=>'orientationletter.show',
                            ])->render();
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
        if(Auth::guard('doctor')->user()->id == $id)
            return redirect(route('doctor.profile'));
        else
        {
            $doctor = Doctor::find($id);
            return view('doctor.edit',['doctor'=>$doctor]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Doctor\DoctorUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorUpdateRequest $request, $id)
    {
        $doctor = Doctor::find($id);

        $array_request = $this->processUpdateRequest($request);
        $doctor->update($array_request);

        $request->session()->flash('update_doctor',$doctor->last_name .' ' . $doctor->first_name .' a été Mise a Jour.');
        return redirect(route('doctor.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctor::findOrFail($id)->delete();
        session()->flash('destroy_doctor','Un Docteur a été supprimer.');
        return redirect(route('doctor.index'));
    }


    /**
     * Show the Profile Of Auth Doctor.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('doctor.profile');
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
    public function processStoreRequest(DoctorStoreRequest $request)
    {
        $request['password'] = Hash::make($request->input('password'));
        $array_except= ['_token'];
        if($request['specialty']==null)
            array_push($array_except,'specialty');

        return $request->except($array_except);
    }

     /**
     * Process the Update Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processUpdateRequest(DoctorUpdateRequest $request)
    {
        $array_except= ['_token'];
        if($request['specialty']==null)
            array_push($array_except,'specialty');

        return $request->except($array_except);
    }

    //Ajax Request for other Controller to use
    public function getAllDoctorForDropdown(){
        $array_doctors['doctors'] = Doctor::orderby("last_name","asc")
            ->orderby("first_name","asc")
            ->select('id','last_name','first_name')
            ->get();

        return response()->json($array_doctors);
    }
    //
}
