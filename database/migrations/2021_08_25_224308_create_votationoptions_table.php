<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotationoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votationoptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('votation_id');
            $table->string('name');
            $table->timestamps();
            $table->foreign('votation_id')->references('id')->on('votations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votationoptions');
    }
}
