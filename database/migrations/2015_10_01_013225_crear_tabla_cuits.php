<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCuits extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('descripcion',25);
			$table->string('cuit',13);
			$table->index('cuit')->unique();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cuits');
	}

}
