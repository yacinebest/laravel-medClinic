<?php

use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Doctor::class)->create([
            'is_admin'=>true,
            'username'=>'doc1',
            'email'=>'doctor1@gmail.com',
            'specialty'=>'médecine interne'
        ]);

        factory(\App\Models\Doctor::class)->create([
            'username'=>'doc2',
            'email'=>'doctor2@gmail.com',
            'specialty'=>'ophtalmologie.'
        ]);
    }
}
