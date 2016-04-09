<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovicheque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movicheque', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('concepto_id')->unsigned();
                $table->string('comentario',30);
                $table->decimal('importe',10,2);
                $table->integer('operacion_id')->unsigned();
                $table->timestamps();
                $table->foreign('concepto_id')->references('id')->on('conceptos')
      			  ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::drop('movicheque');
    }
}
