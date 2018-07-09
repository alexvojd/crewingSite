<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVacanciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Vacancies', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('landingDate');
			$table->integer('salary');
			$table->integer('contract');
			$table->integer('experience');
			$table->integer('bhp');
			$table->integer('dwt');
			$table->date('publicDate');
			$table->integer('yearOfConstruct');
			$table->text('message', 65535);
			$table->integer('idCompany')->index('CompanyInVacan');
			$table->integer('idRole')->index('RoleInVacan');
			$table->integer('idLevelOfEng')->index('EnglishLevelsInVacancy');
			$table->integer('idVesselType')->index('VesselTypeInVacan');
			$table->integer('idEngineType')->index('EngineTypeInVacan');
			$table->integer('views');
			$table->integer('hidden')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Vacancies');
	}

}
