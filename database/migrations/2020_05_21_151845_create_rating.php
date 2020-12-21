<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_host')->unsigned();
            $table->foreign('user_host')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('user_comment')->unsigned();
            $table->foreign('user_comment')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('id_order')->unsigned();
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->tinyInteger('star_rate')->default(3);
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
        Schema::dropIfExists('rating');
    }
}
