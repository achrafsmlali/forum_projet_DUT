<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sous_admins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('catg_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->foreign('catg_id')->references('id')->on('categories')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sous_admins');
	}

}
