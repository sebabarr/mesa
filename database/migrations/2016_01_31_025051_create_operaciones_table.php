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
			
			
			$table->enum('tipo_mov',['compra','venta','aporte','retiro']);
			$table->decimal('cotizacion',5,2);
			$table->decimal('cantidad',10,2);
			$table->decimal('importe',10,2);
			
			$table->integer('cliente_id')->unsigned();
			$table->foreign('cliente_id')->references('id')->on('clientes')
      			  ->onDelete('cascade');
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
