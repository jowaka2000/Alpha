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
            $table->id()->from(1111);
            $table->foreignId('user_id');
            $table->string('assignment_type');
            $table->string('subject');
            $table->string('service');
            $table->integer('pages');
            $table->integer('words');
            $table->string('spacing');
            $table->string('sources');
            $table->string('citation');
            $table->string('deadline');
            $table->string('pay_day');
            $table->string('language');
            $table->mediumText('topic');
            $table->longText('description')->nullable();
            $table->string('status');
            $table->string('stage');
            $table->bigInteger('bids');
            $table->double('price');
            $table->boolean('paid')->default(false);
            $table->string('order_visibility');
            $table->json('old_data')->nullable();
            $table->longText('search_id')->nullable();
            $table->softDeletes()->nullable();
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
