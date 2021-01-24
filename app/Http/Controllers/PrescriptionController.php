<?php

namespace App\Http\Controllers;

use App\Http\Requests\Prescription\PrescriptionStoreRequest;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;

class PrescriptionController extends Controller
{
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
        return redirect()->back();
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
