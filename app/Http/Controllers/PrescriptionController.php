<?php

namespace App\Http\Controllers;

use App\Http\Requests\Prescription\PrescriptionStoreRequest;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('prescription.index');
    }
    //Ajax
    public function getAllPrescription(Request $request){
        if ($request->ajax()) {
            $data = Prescription::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('patient_full_name',function(Prescription $prescription){
                    return view('layouts.includes.tables.datatable.full_name',['entity'=>$prescription->patient])->render();
                })
                ->addColumn('doctor_full_name',function(Prescription $prescription){
                    return view('layouts.includes.tables.datatable.full_name',[
                        'entity'=>$prescription->doctor,
                        'route_show'=>'doctor.show'])->render();
                })
                ->addColumn('action',function(Prescription $prescription)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                            ['id'=>$prescription->id,'name_id'=>'prescription',
                            'route_delete'=>'prescription.destroy',
                            'route_edit'=>'prescription.edit',
                            /*'route_show'=>'prescription.show'*/])->render();
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
        return view('prescription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrescriptionStoreRequest $request)
    {
        $array_request = $this->processStoreRequest($request);
        $prescription = Prescription::create($array_request);
        $request->session()->flash('store_prescription','Vous avez cree une prescription pour Le Patient '
            .$prescription->patient->last_name . ' ' .$prescription->patient->first_name . '.');
        return redirect(route('prescription.index'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
    public function processStoreRequest(PrescriptionStoreRequest $request)
    {
        $array_except= ['_token'];

        return $request->except($array_except);
    }
}
