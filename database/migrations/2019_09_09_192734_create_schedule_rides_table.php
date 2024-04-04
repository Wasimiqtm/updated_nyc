<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_rides', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('rider_id')->default(0)->index()->unsigned();
                $table->foreign('rider_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('category_id')->default(0)->index()->unsigned();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->string('pickup_lat',100)->nullable();
                $table->string('pickup_lon',100)->nullable();
                $table->string('dropoff_lat',100)->nullable();
                $table->string('dropoff_lon',100)->nullable();
                $table->timestamp('ride_date')->nullable();
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
        Schema::drop('schedule_rides');
    }
}
