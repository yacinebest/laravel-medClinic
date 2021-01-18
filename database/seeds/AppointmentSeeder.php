<?php

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Appointment
        $doctors = Doctor::all();
        $patients = Patient::all();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(0));
        $a->patient()->associate($patients->get(0));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(0));
        $a->patient()->associate($patients->get(2));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(0));
        $a->patient()->associate($patients->get(3));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(0));
        $a->patient()->associate($patients->get(4));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(0));
        $a->patient()->associate($patients->get(5));
        $a->save();


        // Doc 2

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(1));
        $a->patient()->associate($patients->get(2));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(1));
        $a->patient()->associate($patients->get(6));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(1));
        $a->patient()->associate($patients->get(7));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(1));
        $a->patient()->associate($patients->get(8));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(1));
        $a->patient()->associate($patients->get(9));
        $a->save();

        $a = factory(\App\Models\Appointment::class)->create();
        $a->doctor()->associate($doctors->get(1));
        $a->patient()->associate($patients->get(11));
        $a->save();

    }
}
