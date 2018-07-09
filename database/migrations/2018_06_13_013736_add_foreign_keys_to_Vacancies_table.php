<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVacanciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Vacancies', function(Blueprint $table)
		{
			$table->foreign('idCompany', 'CompanyInVacan')->references('id')->on('Companies')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idEngineType', 'EngineTypeInVacan')->references('id')->on('EngineTypes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idLevelOfEng', 'EnglishLevelsInVacancy')->references('id')->on('EnglishLevels')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idRole', 'RoleInVacan')->references('id')->on('Roles')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idVesselType', 'VesselTypeInVacan')->references('id')->on('VesselTypes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Vacancies', function(Blueprint $table)
		{
			$table->dropForeign('CompanyInVacan');
			$table->dropForeign('EngineTypeInVacan');
			$table->dropForeign('EnglishLevelsInVacancy');
			$table->dropForeign('RoleInVacan');
			$table->dropForeign('VesselTypeInVacan');
		});
	}

}
