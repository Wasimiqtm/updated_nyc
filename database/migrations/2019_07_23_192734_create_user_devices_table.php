<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('user_id')->default(0)->index()->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->text('token')->nullable();
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
        Schema::drop('user_devices');
    }
}
