<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('user_id')->default(0)->index()->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('name')->nullable();
                $table->string('latitude',30)->nullable();
                $table->string('longitude',30)->nullable();
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
        Schema::drop('user_address');
    }
}
