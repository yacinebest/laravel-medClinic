<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\AppointmentStoreRequest;
use App\Http\Requests\Appointment\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class AppointmentController extends Controller
{

    public function __construct() {
        $this->middleware('admin_or_secretary.auth',['only'=>['index','getAllAppointment']]);
        $this->middleware('doctor_or_secretary.auth',['only'=>['create','store'
                                                                ,'edit'
                                                                ,'update'
                                                                ,'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointment.index');
    }
    //Ajax
    public function getAllAppointment(Request $request){
        if ($request->ajax()) {
            $data = Appointment::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('patient_full_name',function(Appointment $appointment){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$appointment->patient])->render();
                })
                ->addColumn('doctor_full_name',function(Appointment $appointment){
                    return view('layouts.includes.tables.datatable.full_name',[
                        'entity'=>$appointment->doctor,
                        'route_show'=>'doctor.show'])->render();
                })
                ->addColumn('action',function(Appointment $appointment)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                            ['id'=>$appointment->id,'name_id'=>'appointment',
                            'route_delete'=>'appointment.destroy',
                            'route_edit'=>'appointment.edit'])->render();
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
        return view('appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentStoreRequest $request)
    {
        $array_request = $this->processStoreRequest($request);
        $appointment = Appointment::create($array_request);
        $request->session()->flash('store_appointment',
            'Le Patient "' . $appointment->patient->last_name . ' ' . $appointment->patient->first_name .'"
             a un Rendez-vous avec Le Docteur "' . $appointment->doctor->last_name . ' ' . $appointment->doctor->first_name .
            '" Le ' . $appointment->date . ' a ' . $appointment->start_at . '.');
        return redirect(route('appointment.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        if($appointment)
            return view('appointment.edit',['appointment'=>$appointment]);
        else
            return redirect(route('appointment.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentUpdateRequest $request, $id)
    {
        $appointment = Appointment::find($id);
        if($appointment){
            $array_request = $this->processUpdateRequest($request);
            $appointment->update($array_request);

            $request->session()->flash('update_appointment','Le Rendez-vous '.$appointment->id. ' a été Mise a Jour.');
        }
        return redirect(route('appointment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        session()->flash('destroy_appointment','Un Rendez-vous a été supprimer.');
        return redirect(route('appointment.index'));
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
    public function processStoreRequest(AppointmentStoreRequest $request)
    {
        $array_except= ['_token'];
        if($request['reason']==null)
            array_push($array_except,'reason');

        return $request->except($array_except);
    }


      /**
     * Process the Update Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processUpdateRequest(AppointmentUpdateRequest $request)
    {
        $array_except= ['_token'];
        if($request['reason']==null)
            array_push($array_except,'reason');

        return $request->except($array_except);
    }
}
