<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();            
            $table->string('profile_image')->nullable()->default(NULL);
            $table->tinyInteger('gender')->default(0)->comment('Male: 1, Female: 2');
            $table->string('phone',100)->nullable();            
            $table->string('password');
            $table->tinyInteger('status')->default(0)->comment('Active: 1, Inactive: 0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
