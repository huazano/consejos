<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('georeferences')->nullable();
            $table->string('schedule')->nullable();
            $table->string('convocatoria')->nullable();
            $table->integer('boletas')->default(0);
            $table->integer('emitidos')->default(0);
            $table->integer('si')->default(0);
            $table->integer('no')->default(0);
            $table->integer('validos')->default(0);
            $table->integer('nulos')->default(0);
            $table->integer('anulados')->default(0);
            $table->integer('juridico_emitidos')->default(0);
            $table->integer('juridico_si')->default(0);
            $table->integer('juridico_no')->default(0);
            $table->integer('juridico_validos')->default(0);
            $table->integer('juridico_nulos')->default(0);
            $table->integer('juridico_anulados')->default(0);
            $table->string('verificador')->nullable();
            $table->dateTime('llegada_verificador')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
