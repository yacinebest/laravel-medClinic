<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration {

	 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('doctors', function(Blueprint $table) {
			$table->id();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('username');
			$table->string('password');
			$table->string('email');
			$table->boolean('is_admin')->default(false);
            $table->string('specialty')->default('');
            $table->rememberToken();
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
		Schema::dropIfExists('doctors');
	}
}
