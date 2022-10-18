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
        Schema::create('unlocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->foreignId('assigned_user_id')->nullable();
            $table->string('unlock_type');
            $table->longText('unlock_link')->nullable();
            $table->longText('question');
            $table->string('message')->nullable();
            $table->string('instructions')->nullable();
            $table->json('old_unlock_data')->nullable();

            //submiting answers
            $table->string('completed_message')->nullable();
            $table->longText('completed_link')->nullable();
            $table->longText('answers')->nullable();
            $table->timestamp('submited_at')->nullable();
            $table->timestamp('updating_time')->nullable();
            $table->json('old_completed_data')->nullable();//during update


            //refunding
            $table->longText('refund_instructions')->nullable();
            $table->string('refund_message')->nullable();
            $table->string('problem')->nullable();
            $table->timestamp('time_for_refund')->nullable();
            $table->integer('number_of_refund')->default(0);

            $table->double('amount');
            $table->string('status');
            $table->boolean('paid')->default(false);
            $table->timestamp('time_assigned')->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('reported')->default(false);
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
        Schema::dropIfExists('unlocks');
    }
};
