<?php

use App\Models\Patient;
use Illuminate\Database\Seeder;

class ImagerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = Patient::all();

        $list_i = factory(\App\Models\Imagery::class,5)->create();
        foreach ($list_i as $i) {
            $i->patient()->associate($patients->get(0));
            $i->save();
        }

        $list_i = factory(\App\Models\Imagery::class,4)->create();
        foreach ($list_i as $i) {
            $i->patient()->associate($patients->get(2));
            $i->save();
        }

        $list_i = factory(\App\Models\Imagery::class,2)->create();
        foreach ($list_i as $i) {
            $i->patient()->associate($patients->get(3));
            $i->save();
        }

        $list_i = factory(\App\Models\Imagery::class,1)->create();
        foreach ($list_i as $i) {
            $i->patient()->associate($patients->get(4));
            $i->save();
        }
    }
}
