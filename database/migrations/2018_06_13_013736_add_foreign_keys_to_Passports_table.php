<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPassportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Passports', function(Blueprint $table)
		{
			$table->foreign('idResume', 'ResumeInPass')->references('id')->on('Resumes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Passports', function(Blueprint $table)
		{
			$table->dropForeign('ResumeInPass');
		});
	}

}
