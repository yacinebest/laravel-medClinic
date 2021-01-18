<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration {

	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('appointments', function(Blueprint $table) {
			$table->id();
			$table->date('date');
            $table->string('reason')->default('');
            $table->timestamp('start_at')->useCurrent();
            $table->timestamp('end_at')->useCurrent();
            $table->integer('patient_id')->index()->unsigned()->nullable();
            $table->integer('doctor_id')->index()->unsigned()->nullable();
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
		Schema::dropIfExists('appointments');
	}
}
