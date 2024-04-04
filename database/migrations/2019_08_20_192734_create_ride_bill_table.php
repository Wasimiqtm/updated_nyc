<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRideBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_bill', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('ride_id')->default(0)->index()->unsigned();
                $table->foreign('ride_id')->references('id')->on('rides')->onDelete('cascade');
                $table->string('base_fare')->nullable();
                $table->string('cost_per_mile')->nullable();
                $table->string('cost_per_minute')->nullable();
                $table->string('meet_greet_fee')->nullable();
                $table->string('distance')->nullable();
                $table->string('duration')->nullable();
                $table->string('other_charges')->nullable();
                $table->string('total_charges')->nullable();
                $table->string('cancelation_charges')->nullable();
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
        Schema::drop('ride_bill');
    }
}
