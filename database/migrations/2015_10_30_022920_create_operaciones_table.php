<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('moneda',['Dolar','Euro','Real']);
			$table->string('comprador',20);
			$table->string('vendedor',20);
			$table->enum('tipo_mov',['compra','venta','aporte','retiro']);
			$table->decimal('cotizacion',5,2);
			$table->decimal('cantidad',10,2);
			$table->decimal('importe',10,2);
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
		Schema::drop('operaciones');
	}

}
