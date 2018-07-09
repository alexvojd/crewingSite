<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResumesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Resumes', function(Blueprint $table)
		{
			$table->foreign('idLevelOfEng', 'EnglishLevelInResume')->references('id')->on('EnglishLevels')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idRole', 'RoleInResume')->references('id')->on('Roles')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idSailor', 'SailorInResume')->references('id')->on('Sailors')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Resumes', function(Blueprint $table)
		{
			$table->dropForeign('EnglishLevelInResume');
			$table->dropForeign('RoleInResume');
			$table->dropForeign('SailorInResume');
		});
	}

}
