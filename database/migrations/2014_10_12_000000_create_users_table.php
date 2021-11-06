<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('registration_code');
            $table->string('name');
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('username')->unique();
            $table->timestamp('username_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('status')->default(false);
            $table->rememberToken();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
