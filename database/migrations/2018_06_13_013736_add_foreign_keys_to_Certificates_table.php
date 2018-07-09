<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Certificates', function(Blueprint $table)
		{
			$table->foreign('idResume', 'ResumeInCertif')->references('id')->on('Resumes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Certificates', function(Blueprint $table)
		{
			$table->dropForeign('ResumeInCertif');
		});
	}

}
