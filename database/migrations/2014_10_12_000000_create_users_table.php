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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique()->index();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile', 10)->nullable();
            $table->string('password');
            $table->dateTime('password_change_at')->nullable();
            $table->string('status', '10')->default(\App\Enums\UserStatusEnum::Active->value);
            $table->string('temp', 32)->nullable();
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
