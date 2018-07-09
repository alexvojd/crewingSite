<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Resumes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('availableDate');
			$table->integer('salary');
			$table->date('updateDate');
			$table->text('message', 65535)->nullable();
			$table->integer('views');
			$table->integer('hidden')->default(0);
			$table->integer('idRole')->index('RoleInResume');
			$table->integer('idLevelOfEng')->index('EnglishLevelInResume');
			$table->integer('idSailor')->index('SailorInResume');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Resumes');
	}

}
