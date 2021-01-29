<?php

namespace App\Http\Controllers;


use App\Http\Requests\Clinic\ClinicStoreRequest;
use App\Http\Requests\Clinic\ClinicUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Clinic;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\DataTables;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $hasclinic = Clinic::count()>0 ? true : false;
        return view('clinic.index',['hasclinic'=>$hasclinic]);
    }
    //Ajax
    public function getTheClinic(Request $request){
        if ($request->ajax()) {
            $data = Clinic::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function(Clinic $clinic)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                            ['id'=>$clinic->id,'name_id'=>'clinic',
                            'route_delete'=>'clinic.destroy',
                            'route_edit'=>'clinic.edit'])->render();
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
        return view('clinic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ClinicStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicStoreRequest $request)
    {
        $array_request = $this->processStoreRequest($request);
        $cln = Clinic::create($array_request);
        $request->session()->flash('store_clinic',$cln->name .'a été Ajouté comme clinique.');
        return redirect(route('clinic.index'));
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
        $clinic = Clinic::find($id);
        return view('clinic.edit',['clinic'=>$clinic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ClinicUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicUpdateRequest $request, $id)
    {
        $clinic = Clinic::find($id);

        $array_request = $this->processUpdateRequest($request);
        $clinic->update($array_request);

        $request->session()->flash('update_clinic',$clinic->name .' a été Mise a Jour.');
        return redirect(route('clinic.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clinic::findOrFail($id)->delete();
        session()->flash('destroy_clinic','La Clinique a été supprimée.');
        return redirect(route('clinic.index'));
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
    public function processStoreRequest(ClinicStoreRequest $request)
    {
        $array_except= ['_token'];
        return $request->except($array_except);
    }

     /**
     * Process the Update Request
     *
     * @param  mixed $request
     * @return array
     */
    public function processUpdateRequest(ClinicUpdateRequest $request)
    {
        $array_except= ['_token'];

        return $request->except($array_except);
    }
}
