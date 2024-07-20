<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetaTable extends Migration
{
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nome');
            $table->string('cognome');
            $table->string('indirizzo')->nullable();
            $table->string('cap')->nullable();
            $table->string('citta')->nullable();
            $table->string('provincia')->nullable();
            $table->unsignedBigInteger('nazione_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('nazione_id')->references('id')->on('countries');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_meta');
    }
}