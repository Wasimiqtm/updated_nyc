<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDriverCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_car', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('user_id')->default(0)->index()->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('model_id')->default(0)->index()->unsigned();
                $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');                 
                $table->string('registration_number')->nullable();
                $table->string('year')->nullable();
                $table->string('driver_license')->nullable();
                $table->string('tlc_license')->nullable();               
                $table->string('car_registration')->nullable();               
                $table->string('tlc_insurance')->nullable();               
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
        Schema::drop('driver_car');
    }
}
