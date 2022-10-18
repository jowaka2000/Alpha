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
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->boolean('unlocks_subscribed')->default(false);
            $table->timestamp('unlocks_subscription_end')->nullable();
            $table->integer('unlocks_plan')->nullable();
            $table->boolean('unlock_subscription_expired')->default(true);
            $table->boolean('orders_subscribed')->default(false);
            $table->timestamp('orders_subscription_end')->nullable();
            $table->integer('orders_plan')->nullable();
            $table->boolean('order_subscription_expired')->default(true);
            $table->boolean('unlocks_notified')->default(false);
            $table->boolean('orders_notified')->default(false);
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
        Schema::dropIfExists('accesses');
    }
};
