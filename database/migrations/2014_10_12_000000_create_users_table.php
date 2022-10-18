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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('search_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('number');
            $table->json('employers')->nullable();
            $table->string('chanel')->nullable();//employer
            $table->string('availability')->nullable();//writer
            $table->string('user_type');
            $table->boolean('blocked')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('success_rate')->nullable();
            $table->integer('reliable_rate')->nullable();
            $table->bigInteger('orders')->default(0);
            $table->bigInteger('refunds')->nullable();
            $table->bigInteger('rejected')->nullable();
            $table->longText('policies')->nullable();  //client policies
            $table->string('image')->nullable();
            $table->json('subjects')->nullable();
            $table->string('refferal_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('phone_verified')->default(true);
            $table->string('password');
            $table->string('old_password')->nullable();
            $table->json('old_profile_data')->nullable();
            $table->boolean('online')->default(false);
            $table->boolean('valid')->default(false);//if the user subscribed or has more referal points , he or she is valid
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
