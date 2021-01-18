<?php

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Patient::class)->create([
            'email'=>'pat1@gmail.com'
        ]);

        factory(\App\Models\Patient::class)->create([
            'email'=>'pat2@gmail.com'
        ]);

        factory(\App\Models\Patient::class,10)->create();

    }
}
