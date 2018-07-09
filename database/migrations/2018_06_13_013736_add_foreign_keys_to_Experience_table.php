<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExperienceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Experience', function(Blueprint $table)
		{
			$table->foreign('idEngineType', 'EngineTypeInExp')->references('id')->on('EngineTypes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idResume', 'ResumeInExp')->references('id')->on('Resumes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idRole', 'RoleInExp')->references('id')->on('Roles')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idVesselType', 'VesselTypeInExp')->references('id')->on('VesselTypes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Experience', function(Blueprint $table)
		{
			$table->dropForeign('EngineTypeInExp');
			$table->dropForeign('ResumeInExp');
			$table->dropForeign('RoleInExp');
			$table->dropForeign('VesselTypeInExp');
		});
	}

}
