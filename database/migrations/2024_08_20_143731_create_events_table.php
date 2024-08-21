<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->string('luogo');
            $table->string('indirizzo');
            $table->string('comune');
            $table->string('provincia');
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->integer('posti');
            $table->integer('ospiti');
            $table->boolean('gratuito')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
