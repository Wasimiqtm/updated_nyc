<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_models', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('category_id')->default(0)->index()->unsigned();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');                 
                $table->integer('model_id')->default(0)->index()->unsigned();
                $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');                 
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
        Schema::drop('category_models');
    }
}
