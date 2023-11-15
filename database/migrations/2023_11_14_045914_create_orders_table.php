<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->string('order_number')->unique();
            $table->unsignedBigInteger('total_price');
            $table->set('shipment_status',["Pending","Processing","Shipped","Delivered"])->default('Pending');
            $table->set("payment_status", ["paid", "accepted", "rejected"])->default("paid");
            $table->string('payment_proof');
            $table->text('shipping_address');
            $table->string('payment_method');
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
};
