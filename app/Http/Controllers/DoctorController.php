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
        $this->middleware('doctor.auth');
        $this->middleware('admin.auth', ['except' => ['home','profile','show'
                                                    ,'getAppointmentsForDoctor'
                                                    ,'getPrescriptionsForDoctor'
                                                    ,'getOrientationLettersForDoctor']]);
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
        $doctors = Doctor::orderBy('last_name', 'Asc')
                        ->orderBy('first_name', 'Asc')
                        ->paginate(10);
        return view('doctor.index',['doctors'=>$doctors]);
    }

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
        if ($request->ajax()) {
            $data = Appointment::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('patient_full_name',function(Appointment $appointment){
                    return "<a href=\"" .'#' . "\">".
                            $appointment->patient->last_name . ' ' . $appointment->patient->first_name .
                            '</a>';
                })
                ->addColumn('action',function(Appointment $appointment)
                {
                    return $this->actions($appointment->id,'appointment');
                })
                ->rawColumns(['action','patient_full_name'])
                ->make(true);
        }
    }
    public function getPrescriptionsForDoctor(Request $request)
    {
          if ($request->ajax()) {
            $data = Prescription::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('patient_full_name',function(Prescription $prescription){
                    return "<a href=\"" .'#' . "\">".
                            $prescription->patient->last_name . ' ' . $prescription->patient->first_name .
                            '</a>';
                })
                ->addColumn('action',function(Prescription $prescription)
                {
                    return $this->actions($prescription->id,'prescription');
                })
                ->rawColumns(['action','patient_full_name'])
                ->make(true);
        }
    }
    public function getOrientationLettersForDoctor(Request $request)
    {
          if ($request->ajax()) {
            $data = OrientationLetter::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('content_preview',function(OrientationLetter $orientationLetter){
                    return Str::limit($orientationLetter->content, 50, '...');
                })
                ->addColumn('patient_full_name',function(OrientationLetter $orientationLetter){
                    return "<a href=\"" .'#' . "\">".
                            $orientationLetter->patient->last_name . ' ' . $orientationLetter->patient->first_name .
                            '</a>';
                })
                ->addColumn('action',function(OrientationLetter $orientationLetter)
                {
                    return $this->actions($orientationLetter->id,'orientationLetter');
                })
                ->rawColumns(['action','patient_full_name'])
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
}
