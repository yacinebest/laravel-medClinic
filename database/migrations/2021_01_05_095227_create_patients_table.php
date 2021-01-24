<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration {

	 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('patients', function(Blueprint $table) {
			$table->id();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('social_security_number')->default('');
			$table->date('birth_date');
			$table->string('phone_number');
			$table->string('address');
			$table->string('email');
			$table->text('chronic_diseases')->nullable();
			$table->text('allergies')->nullable();
			$table->text('antecedents')->nullable();
            $table->text('comments')->nullable();
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
		Schema::dropIfExists('patients');
	}
}
