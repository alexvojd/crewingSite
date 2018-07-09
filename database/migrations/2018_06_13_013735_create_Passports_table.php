<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePassportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Passports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nameOfDoc', 35);
			$table->string('passCode', 6);
			$table->integer('passNum');
			$table->string('issuePlace', 50);
			$table->date('expiryDate')->nullable();
			$table->string('scanName', 25)->nullable();
			$table->integer('idResume')->index('ResumeInPass');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Passports');
	}

}
