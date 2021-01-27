<?php

namespace App\Http\Controllers;

use App\Models\Imagery;
use App\Models\Patient;
use Illuminate\Http\Request;

class ImageryController extends Controller
{

    public function __construct() {
        $this->middleware('doctor.auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        if($patient!=null)
            return view('imagery.create',['patient'=>$patient]);
        else
            return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         # Get the file from the post request
         $file = $request->file('file');

         # Set the file name
         $filename = uniqid() . $file->getClientOriginalName();

         # Check for the folder
         if (!file_exists('imageries')) {
             mkdir('imageries', 0777, true);
         }

         # Move the file to correct location
         $file->move('imageries', $filename);

         # And save the image to the database
        $image = Imagery::create(['file'=>$filename,'patient_id'=>$request['patient_id']]);

        return $image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Imagery::find($id);
        $patient_id = $image->patient_id;
        $path = public_path() . '/images/' . $image->file;
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();
        return redirect(route('patient.show',['patient'=>$patient_id]));
    }
}
