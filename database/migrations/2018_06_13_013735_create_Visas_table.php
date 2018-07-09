<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Visas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('number', 20);
			$table->string('type', 10);
			$table->date('expiryDate');
			$table->string('scanName', 15)->nullable();
			$table->integer('idResume')->index('VisaInResume');
			$table->integer('idVisaType')->index('VisaTypeInVisas');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Visas');
	}

}
