<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // id_county was a plain INT, but counties.id is a BIGINT (and, on this
        // server, signed rather than unsigned) - types must match exactly
        // before MySQL/MariaDB will accept a foreign key.
        DB::statement('ALTER TABLE cities MODIFY id_county BIGINT NOT NULL');

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

        DB::statement('ALTER TABLE cities MODIFY id_county INT NOT NULL');
    }
};
