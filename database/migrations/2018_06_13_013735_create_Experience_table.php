<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExperienceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Experience', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nameOfVes', 25);
			$table->integer('DWT');
			$table->integer('BHP');
			$table->string('flag', 35);
			$table->string('shipowner', 35);
			$table->string('crewing', 35);
			$table->date('dateFrom');
			$table->date('dateTo');
			$table->integer('idEngineType')->index('EngineTypeInExp');
			$table->integer('idVesselType')->index('VesselTypeInExp');
			$table->integer('idResume')->index('ResumeInExp');
			$table->integer('idRole')->index('RoleInExp');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Experience');
	}

}
