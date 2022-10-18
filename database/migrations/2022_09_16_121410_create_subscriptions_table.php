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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('phone_number');
            $table->string('merchant_request_id');
            $table->string('customer_message');
            $table->string('checkout_request_id');
            $table->string('amount');
            $table->integer('plan')->nullable();
            $table->boolean('completed')->default(0);
            $table->boolean('phone_verification')->default(0);
            $table->string('subscription_type')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
};
