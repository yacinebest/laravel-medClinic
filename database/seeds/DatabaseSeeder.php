<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DoctorSeeder::class);
        $this->call(ClinicSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(SecretarySeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(ImagerySeeder::class);
        $this->call(OrientationLetterSeeder::class);
        $this->call(PrescriptionSeeder::class);
    }
}
