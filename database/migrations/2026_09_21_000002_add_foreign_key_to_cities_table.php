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
        // id_county was a plain INT, but counties.id (from $table->id()) is
        // an unsigned BIGINT - types must match exactly before MySQL/MariaDB
        // will accept a foreign key on this column.
        Schema::table('cities', function (Blueprint $table) {
            $table->unsignedBigInteger('id_county')->change();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('id_county')->references('id')->on('counties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign(['id_county']);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->integer('id_county')->change();
        });
    }
};
