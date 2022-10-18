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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('result_code');
            $table->string('result_description');
            $table->string('merchant_request_id');
            $table->string('checkout_request_id');
            $table->string('amount')->nullable();
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->nullable();
            $table->boolean('completed')->default(0);
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
        Schema::dropIfExists('transactions');
    }
};
