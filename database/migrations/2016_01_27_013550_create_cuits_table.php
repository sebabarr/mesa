<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('cuits', function(Blueprint $table) {
                $table->increments('id');
                $table->string('razonsocial',30)->index();
                $table->string('numero',13)->index();
                $table->decimal('limite',10,2);
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
        Schema::drop('cuits');
    }

}
