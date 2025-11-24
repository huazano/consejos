<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('door_id');
            $table->unsignedBigInteger('attendance_location_id')->nullable();
            $table->unsignedBigInteger('attendance_door_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->datetime('attendance_date')->nullable();
            $table->unique(['event_id', 'user_id']);
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('door_id')->references('id')->on('doors');
            $table->foreign('attendance_location_id')->references('id')->on('locations');
            $table->foreign('attendance_door_id')->references('id')->on('doors');
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
