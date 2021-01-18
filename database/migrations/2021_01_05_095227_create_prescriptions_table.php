<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration {

	 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('prescriptions', function(Blueprint $table) {
			$table->id();
            $table->date('date');
            $table->integer('patient_id')->index()->unsigned();
            $table->integer('doctor_id')->index()->unsigned();
            $table->timestamps();
		});
	}

	/**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
	{
		Schema::dropIfExists('prescriptions');
	}
}
