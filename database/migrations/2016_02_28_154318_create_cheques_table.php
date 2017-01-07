<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('cheques', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('nrocheque');
                $table->decimal('importe',10,2);
                $table->integer('id_banco')->unsigned();
                $table->date('fechavto');
                $table->string('id_cuit');
                $table->enum('estado',['cartera','vendido','cobrado','devuelto','gestion']);
                $table->integer('id_cliente')->unsigned();
                $table->integer('id_cartera')->unsigned();
                $table->decimal('desctasa',10,2);
                $table->decimal('descgasto',10,2);
                $table->decimal('descfijo',10,2);
                $table->integer('dias')->unsigned();
                $table->decimal('tasa_desc',5,2);
                $table->integer('cli_ult_liqui');
                $table->decimal('tasa_gast',5,2);
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
        Schema::drop('cheques');
    }

}
