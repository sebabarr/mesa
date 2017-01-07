<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTableChequeven extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('chequeven', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('id_cheque')->unsigned();
                $table->integer('id_tomador')->unsigned();
                $table->date('fechaventa');
                $table->decimal('tasa_descu',5,2);
                $table->decimal('tasa_gasto',5,2);
                $table->decimal('descuentofijo',10,2);
                $table->decimal('descuento',10,2);
                $table->decimal('gasto',10,2);
                $table->decimal('neto',10,2);
                $table->integer('cli_liqui');
                $table->timestamps();
                $table->foreign('id_cheque')
                      ->references('id')->on('cheques')
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
        Schema::drop('chequeven');
    }
}
