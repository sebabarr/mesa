<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('movimientos', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('concepto_id')->unsigned();
                $table->string('comentario',30);
                $table->decimal('importe',10,2);
                $table->integer('operacion_id')->unsigned();
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
        Schema::drop('movimientos');
    }

}
