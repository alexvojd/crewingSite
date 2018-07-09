<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Certificates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 50);
			$table->string('number', 25);
			$table->string('issuePlace', 50);
			$table->date('expiryDate');
			$table->string('scanName', 25)->nullable();
			$table->integer('idResume')->index('ResumeInCertif');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Certificates');
	}

}
