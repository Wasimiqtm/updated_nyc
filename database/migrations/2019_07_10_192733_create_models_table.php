<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('make_id')->default(0)->index()->unsigned();
                $table->foreign('make_id')->references('id')->on('makes')->onDelete('cascade');                 
                $table->string('name');
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
        Schema::drop('models');
    }
}
