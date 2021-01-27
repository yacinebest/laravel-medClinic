<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrientationLetter\OrientationLetterStoreRequest;
use App\Http\Requests\OrientationLetter\OrientationLetterUpdateRequest;
use App\Models\OrientationLetter;
use Illuminate\Http\Request;

class OrientationLetterController extends Controller
{

    public function __construct() {
        $this->middleware('doctor.auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orientationletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrientationLetterStoreRequest $request)
    {
        $array_request = $this->processStoreRequest($request);
        $orientationLetter = OrientationLetter::create($array_request);
        $request->session()->flash('store_orientationLetter',
            'La Lettre d\'Orientation pour Le Patient '
            . $orientationLetter->patient->last_name . ' ' . $orientationLetter->patient->first_name .'A était cree.');
        return redirect(route('patient.show',['patient'=>$orientationLetter->patient->id]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orientationLetter = OrientationLetter::findOrFail($id);
        if($orientationLetter)
            return view('orientationletter.edit',['orientationLetter'=>$orientationLetter]);
        else
            return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrientationLetterUpdateRequest $request, $id)
    {
        $orientationLetter = OrientationLetter::find($id);
        if ($orientationLetter) {
            $array_request = $this->processUpdateRequest($request);
            $orientationLetter->update($array_request);

            $request->session()->flash('update_orientationLetter',
                'La Lettre d\'Orientation pour Le Patient '
                . $orientationLetter->patient->last_name . ' ' . $orientationLetter->patient->first_name .'A était Mise A Jour.');
        }
        return redirect(route('patient.show',['patient'=>$orientationLetter->patient->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrientationLetter::findOrFail($id)->delete();
        session()->flash('destroy_orientationLetter','Une Lettre d\'Orientation a été supprimer.');
        return redirect()->back();
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
    public function processStoreRequest(OrientationLetterStoreRequest $request)
    {
        $array_except= ['_token'];

        return $request->except($array_except);
    }

    /**
     * Process the Store Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processUpdateRequest(OrientationLetterUpdateRequest $request)
    {
        $array_except= ['_token'];

        return $request->except($array_except);
    }
}
