<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Companies', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 50);
			$table->string('fio', 50);
			$table->string('email', 50);
			$table->string('site', 50)->nullable();
			$table->string('contactPhone', 15);
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
		Schema::drop('Companies');
	}

}
