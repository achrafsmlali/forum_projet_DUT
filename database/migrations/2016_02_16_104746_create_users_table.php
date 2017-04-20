<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('first_name');
			$table->string('lats_name');
			$table->string('image_link')->default('default.png');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->date('birthday');
			$table->enum('profile',['admin','membre','sous_admin'])->default('membre');
			$table->enum('sexe',['male','female'])->default('male');
			$table->boolean('email_notf')->default(true);
			$table->text('about_me');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
