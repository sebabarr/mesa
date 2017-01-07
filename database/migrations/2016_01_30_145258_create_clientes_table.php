<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('clientes', function(Blueprint $table) {
                $table->increments('id');
                $table->string('razonsocial',30)->index();
                $table->string('direccion',30);
                $table->string('telefono',30);
                $table->decimal('limite_chp',10,2);
                $table->decimal('limite_cht',10,2);
                $table->decimal('tasa_desc',5,2);
                $table->decimal('tasa_gasto',5,2);
                $table->decimal('gasto_fijo',10,2);
                $table->integer('ult_liqui');
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
        Schema::drop('clientes');
    }

}
