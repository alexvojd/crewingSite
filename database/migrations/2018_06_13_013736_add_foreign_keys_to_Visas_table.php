<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVisasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Visas', function(Blueprint $table)
		{
			$table->foreign('idResume', 'VisaInResume')->references('id')->on('Resumes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idVisaType', 'VisaTypeInVisas')->references('id')->on('VisaTypes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Visas', function(Blueprint $table)
		{
			$table->dropForeign('VisaInResume');
			$table->dropForeign('VisaTypeInVisas');
		});
	}

}
