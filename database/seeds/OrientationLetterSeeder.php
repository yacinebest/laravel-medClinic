<?php

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class OrientationLetterSeeder extends Seeder
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

        $list_o = factory(\App\Models\OrientationLetter::class,10)->create();
        $i = 0 ;
        foreach ($list_o as $o) {
            $o->doctor()->associate($doctors->get(0));
            $o->patient()->associate($patients->get($i));
            $o->save();
            $i++;
        }

        $list_o = factory(\App\Models\OrientationLetter::class,10)->create();
        $i = 0 ;
        foreach ($list_o as $o) {
            $o->doctor()->associate($doctors->get(1));
            $o->patient()->associate($patients->get($i));
            $o->save();
            $i++;
        }

    }
}
