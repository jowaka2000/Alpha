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
        Schema::create('completeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('order_id');
            $table->foreignId('employer_id');
            //include a table of paid =true or false
            $table->boolean('paid')->default(false);
            $table->string('answer_type');
            $table->string('message')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('topic');
            $table->string('status');
            $table->string('search_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('completeds');
    }
};
