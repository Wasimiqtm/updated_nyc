<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('rider_id')->default(0)->index()->unsigned();
                $table->foreign('rider_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('driver_id')->default(0)->index();
                $table->integer('category_id')->default(0)->index()->unsigned();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->string('pickup_lat',100)->nullable();
                $table->string('pickup_lon',100)->nullable();
                $table->string('dropoff_lat',100)->nullable();
                $table->string('dropoff_lon',100)->nullable();
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
        Schema::drop('rides');
    }
}
