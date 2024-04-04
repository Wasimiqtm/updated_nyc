<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCardInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_card_info', function(Blueprint $table) {
                $table->increments('id');    
                $table->integer('user_id')->default(0)->index()->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('card_number')->nullable();
                $table->string('expiry_month',30)->nullable();
                $table->string('expiry_year',30)->nullable();
                $table->string('cv_code',30)->nullable();
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
        Schema::drop('user_card_info');
    }
}
