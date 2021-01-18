<?php

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();

        $list_p = factory(\App\Models\Prescription::class,10)->create();
        $i = 0 ;
        foreach ($list_p as $p) {
            $p->doctor()->associate($doctors->get(0));
            $p->patient()->associate($patients->get($i));

            $p->prescriptionLines()->saveMany([
                factory(\App\Models\PrescriptionLine::class)->create(),
                factory(\App\Models\PrescriptionLine::class)->create(),
                factory(\App\Models\PrescriptionLine::class)->create(),
            ]);

            $p->save();
            $i++;
        }

        $list_p = factory(\App\Models\Prescription::class,10)->create();
        $i = 0 ;
        foreach ($list_p as $p) {
            $p->doctor()->associate($doctors->get(1));
            $p->patient()->associate($patients->get($i));

            $p->prescriptionLines()->saveMany([
                factory(\App\Models\PrescriptionLine::class)->create(),
                factory(\App\Models\PrescriptionLine::class)->create(),
                factory(\App\Models\PrescriptionLine::class)->create(),
            ]);

            $p->save();
            $i++;
        }
    }
}
