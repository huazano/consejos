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
            $table->string('qr')->unique()->nullable();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->default('profile_photos/user.png');
            $table->unsignedBigInteger('permission_id')->nullable();
            $table->integer('change_password')->nullable();
            $table->string('curp')->nullable();
            $table->timestamps();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
