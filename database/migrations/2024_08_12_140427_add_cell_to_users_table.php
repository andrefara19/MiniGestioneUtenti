<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('user_meta', function (Blueprint $table) {
        $table->string('cellulare')->after('provincia')->nullable();
    });
}

public function down()
{
    Schema::table('user_meta', function (Blueprint $table) {
        $table->dropColumn('cellulare');
    });
}
};
