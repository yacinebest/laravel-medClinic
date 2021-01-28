<?php

namespace App\Charts;

use App\Helpers\ColorHelper;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Prescription;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SimpleCharts extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static function appointmentPrescriptionCharts()
    {
        $data_appointment =[];
        $data_prescription =[];
        for ($i=1; $i <=12 ; $i++) {
            $nbr_appointment = Appointment::whereYear('date',now()->format('Y'))->whereMonth('date',$i)->count();
            array_push($data_appointment,$nbr_appointment);

            $nbr_prescription = Prescription::whereYear('date',now()->format('Y'))->whereMonth('date',$i)->count();
            array_push($data_prescription,$nbr_prescription);

        }

        $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
        $appointment_prescription_charts = new SimpleCharts;
        $appointment_prescription_charts->labels($months);
        $appointment_prescription_charts->dataset('Nombres RDV:', 'bar', $data_appointment)->backgroundcolor('#4c84ff');;
        $appointment_prescription_charts->dataset('Nombres Prescriptions:', 'bar', $data_prescription)->backgroundcolor('#20c997');;
        return $appointment_prescription_charts;
    }

    public static function appointmentDoctorCharts()
    {
        $data_appointment =[];
        $labels = [];
        $backgroundcolors = [];
        foreach (Doctor::all() as $doctor) {
            $nbr_appointment = $doctor->appointments()->whereMonth('date',now()->subMonth()->format('m'))->count();

            array_push($data_appointment,$nbr_appointment);
            array_push($labels,$doctor->last_name . ' ' . $doctor->first_name);
            array_push($backgroundcolors,'#'.ColorHelper::random_color());
        }

        $appointment_prescription_charts = new SimpleCharts;
        $appointment_prescription_charts->labels($labels);
        $appointment_prescription_charts->dataset('Nombres RDV Du Mois Precedant:', 'pie', $data_appointment)->backgroundcolor($backgroundcolors);
        return $appointment_prescription_charts;
    }



    //

    public static function appointmentPrescriptionForDoctorCharts(Doctor $doctor)
    {
        $data_appointment =[];
        $data_prescription =[];
        for ($i=1; $i <=12 ; $i++) {
            $nbr_appointment = $doctor->appointments()->whereYear('date',now()->format('Y'))->whereMonth('date',$i)->count();
            array_push($data_appointment,$nbr_appointment);

            $nbr_prescription = $doctor->prescriptions()->whereYear('date',now()->format('Y'))->whereMonth('date',$i)->count();
            array_push($data_prescription,$nbr_prescription);

        }

        $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
        $appointment_prescription_charts = new SimpleCharts;
        $appointment_prescription_charts->labels($months);
        $appointment_prescription_charts->dataset('Nombres RDV:', 'bar', $data_appointment)->backgroundcolor('#4c84ff');;
        $appointment_prescription_charts->dataset('Nombres Prescriptions:', 'bar', $data_prescription)->backgroundcolor('#20c997');;
        return $appointment_prescription_charts;
    }
}
