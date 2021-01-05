<?php

use Illuminate\Database\Seeder;

class SecretarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Secretary::class)->create([
            'username'=>'sec1',
            'email'=>'sec1@gmail.com'
        ]);
    }
}
