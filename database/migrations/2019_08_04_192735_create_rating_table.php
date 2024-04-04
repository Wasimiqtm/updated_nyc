<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('ride_id')->default(0)->index()->unsigned();
                $table->foreign('ride_id')->references('id')->on('rides')->onDelete('cascade');
                $table->integer('user_id')->default(0)->index()->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('rating')->default(0)->nullable();
                $table->string('review')->nullable();
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
        Schema::drop('rating');
    }
}
