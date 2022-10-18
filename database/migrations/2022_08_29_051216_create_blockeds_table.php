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
        Schema::create('blockeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade'); //the one who do the blocking
            $table->foreignId('blocked_email'); // the email that has been blocked
            $table->string('place'); //where it has been blocked
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
        Schema::dropIfExists('blockeds');
    }
};
