<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionLinesTable extends Migration {

	 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('prescription_lines', function(Blueprint $table) {
			$table->id();
			$table->string('medicine');
			$table->string('dose');
			$table->string('time_taken');
            $table->string('duration');
            $table->integer('prescription_id')->index()->unsigned()->nullable();
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
		Schema::dropIfExists('prescription_lines');
	}
}
