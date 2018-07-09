<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManagersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Managers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('surname', 25);
			$table->string('name', 25);
			$table->string('patronymic', 25);
			$table->integer('jobID');
			$table->string('email', 50);
			$table->string('password', 20);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Managers');
	}

}
