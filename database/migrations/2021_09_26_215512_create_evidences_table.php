<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidencesTable extends Migration
{
    public function up()
    {
        Schema::create('evidences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('evidencetype_id');
            $table->string('name');
            $table->string('path')->nullable();
            $table->date('limit_date');
            $table->date('uploaded_date')->nullable();
            $table->string('status')->default('pendiente');
            $table->string('sended')->default('no');
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('evidencetype_id')->references('id')->on('evidencetypes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evidences');
    }
}
