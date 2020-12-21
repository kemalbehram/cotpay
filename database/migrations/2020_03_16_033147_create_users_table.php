<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('code_tax')->unique()->nullable();
            $table->string('code_user')->nullable();
            $table->string('name_user')->nullable();
            $table->double('money_bonus')->default(0)->nullable();
            $table->tinyInteger('lock')->default(1)->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('image')->nullable();
            $table->tinyInteger('level');
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('ward')->nullable();
            $table->string('code')->nullable();
            $table->string('code_forgot_password')->nullable();
            $table->datetime('time_forgot_password')->nullable();
            $table->datetime('time_code')->nullable();
            $table->integer('is_active')->default(0);
            $table->float('star_rate')->default(0);
            $table->float('percent_returned')->default(0);
            $table->float('bonus')->nullable();
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
