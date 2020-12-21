<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('user_id_receiver')->unsigned();
            $table->foreign('user_id_receiver')->references('id')->on('users')->onDelete('cascade');
            $table->string('code_deal')->unique();
            $table->tinyInteger('sell_buy');
            $table->double('money_value');
            $table->double('cotpay_fee');
            $table->text('content');
            $table->bigInteger('wallet_id')->unsigned();
            $table->foreign('wallet_id')->references('id')->on('wallet')->onDelete('cascade');
            $table->string('phone_receiver');
            $table->string('name_user');
            $table->string('name_sender');
            $table->string('name_receiver');
            $table->string('address_receiver');
            $table->string('city');
            $table->string('district');
            $table->string('ward');
            $table->string('shipping_unit');
            $table->Integer('wide');
            $table->Integer('long');
            $table->Integer('height');
            $table->tinyInteger('collection');
            $table->tinyInteger('service');
            $table->Integer('weight');
            $table->double('ship_fee');
            $table->text('note')->nullable();
            $table->tinyInteger('status');
            // $table->tinyInteger('qty');
            $table->string('code_bill')->nullable();
            $table->date('date_ship_receive')->nullable();
            $table->date('date_ship_success')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
