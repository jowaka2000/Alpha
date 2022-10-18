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
        Schema::create('unlocks_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('unlock_id');
            $table->string('phone_number');
            $table->string('merchant_request_id');
            $table->string('customer_message');
            $table->string('checkout_request_id');
            $table->string('amount');
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('unlocks_payments');
    }
};
