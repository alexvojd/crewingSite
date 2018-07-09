<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSailorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Sailors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('surname', 25);
			$table->string('name', 25);
			$table->string('patronymic', 25);
			$table->date('birthDate');
			$table->string('country', 35);
			$table->string('region', 35);
			$table->string('city', 35);
			$table->string('permAdress', 25);
			$table->string('nationality', 25);
			$table->string('nearestAirport', 25);
			$table->string('contactPhone', 15);
			$table->string('email', 25);
			$table->string('password', 25);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Sailors');
	}

}
