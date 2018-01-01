<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answer_votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('vote')->unsigned();
			$table->integer('answer_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
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
		Schema::drop('answer_votes');
	}

}
