<?php

namespace App\Http\Controllers;

use App\Http\Request\Patient\PatientStoreRequest;
use App\Http\Request\Patient\PatientUpdateeRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\OrientationLetter;
use App\Models\Prescription;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
//use PhpParser\Comment\Doc;

class PatientController extends Controller
{
    /**
     * Display a dome page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('patient.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::orderBy('last_name', 'Asc')
                        ->orderBy('first_name', 'Asc')
                        ->paginate(10);
        return view('patient.index',['patients'=>$patients]);
    }

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
        $request['password'] = Hash::make($request->input('password'));
        $array_except= ['_token'];

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

        return $request->except($array_except);
    }
}
