<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('UserMessages', function(Blueprint $table)
		{
			$table->foreign('idCompany', 'CompanyInMessage')->references('id')->on('Companyes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('idSailor', 'SailorInMessage')->references('id')->on('Sailors')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('UserMessages', function(Blueprint $table)
		{
			$table->dropForeign('CompanyInMessage');
			$table->dropForeign('SailorInMessage');
		});
	}

}
