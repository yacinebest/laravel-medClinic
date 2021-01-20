<?php

namespace App\Http\Controllers;

use App\Http\Requests\Secretary\SecretaryStoreRequest;
use App\Http\Requests\Secretary\SecretaryUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Secretary;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\DataTables;

class SecretaryController extends Controller
{

    public function __construct() {
        $this->middleware('secretary.auth',['only'=>['home','profile']]);
        $this->middleware('admin.auth',['except'=>['home','profile'] ]);
    }
    /**
     * Display a dome page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('secretary.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretary.index');
    }
    //Ajax
    public function getAllSecretary(Request $request){
        if ($request->ajax()) {
            $data = Secretary::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function(Secretary $secretary)
                {
                    return view('layouts.includes.crud.edit_show_delete_btn',
                            ['id'=>$secretary->id,'name_id'=>'secretary',
                            'route_delete'=>'secretary.destroy',
                            'route_edit'=>'secretary.edit'])->render();
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
        return view('secretary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SecretaryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecretaryStoreRequest $request)
    {
        $array_request = $this->processStoreRequest($request);
        $sec = Secretary::create($array_request);
        $request->session()->flash('store_secretary',$sec->last_name .' ' . $sec->first_name .'a été Ajouté a la liste de seccretaire.');
        return redirect(route('secretary.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $secretary = Secretary::find($id);
        return view('secretary.edit',['secretary'=>$secretary]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SecretaryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SecretaryUpdateRequest $request, $id)
    {
        $secretary = Secretary::find($id);

        $array_request = $this->processUpdateRequest($request);
        $secretary->update($array_request);

        $request->session()->flash('update_secretary',$secretary->last_name .' ' . $secretary->first_name .' a été Mise a Jour.');
        return redirect(route('secretary.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Secretary::findOrFail($id)->delete();
        session()->flash('destroy_secretary','La Secretaire a été supprimée.');
        return redirect(route('secretary.index'));
    }



    /**
     * Show the Profile Of Auth Secretary.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('secretary.profile');
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
    public function processStoreRequest(SecretaryStoreRequest $request)
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
    public function processUpdateRequest(SecretaryUpdateRequest $request)
    {
        $array_except= ['_token'];

        return $request->except($array_except);
    }
}
