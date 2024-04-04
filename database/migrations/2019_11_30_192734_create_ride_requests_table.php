<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRideRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_requests', function(Blueprint $table) {
                $table->increments('id');                     
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('pickup_date')->nullable();
                $table->string('pickup_time')->nullable();
                $table->string('pickup_location')->nullable();
                $table->string('dropoff_location')->nullable();
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
        Schema::drop('ride_requests');
    }
}
