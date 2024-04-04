<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRideStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_status', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('ride_id')->default(0)->index()->unsigned();
                $table->foreign('ride_id')->references('id')->on('rides')->onDelete('cascade');
                $table->enum('status',['pending','on_the_way','arrived','started','reached','completed','canceled'])->default('pending')->comment('pending,on_the_way,arrived,started,reached,completed,canceled');
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
        Schema::drop('ride_status');
    }
}
