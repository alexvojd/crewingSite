<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('UserMessages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 50);
			$table->text('message', 65535);
			$table->integer('senderID');
			$table->date('sendDate');
			$table->integer('idSailor')->index('SailorInMessage');
			$table->integer('idCompany')->index('CompanyInMessage');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('UserMessages');
	}

}
