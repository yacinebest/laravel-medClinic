<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Carbon\Carbon;

class AppointmentHelper {

    public static function checkIfTimeIsPossibleForDoctor(Request $request)
    {
        $doctor = Doctor::findOrFail($request['doctor_id']);
        $appointments_to_check = $doctor->appointments()->whereDay('date',Carbon::parse($request['date'])->format('d'))->get() ;
        foreach ($appointments_to_check as $appointment) {
            if(TimeHelper::checkOverlapForTwoTime( Carbon::parse($appointment->start_at)->format('H:i'),Carbon::parse($appointment->end_at)->format('H:i'),
                                            $request['start_at'],$request['end_at'])){
                return $appointment;
            }
        }
        return null;
    }
}
