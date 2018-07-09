<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('UserRequests', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('userGroup');
			$table->integer('idUser');
			$table->text('message', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('UserRequests');
	}

}
