<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // MariaDB 10.4 does not support the native RENAME COLUMN syntax
        // (added in 10.5.2), so CHANGE COLUMN is used instead. The existing
        // idx_city index automatically follows the column rename.
        DB::statement('ALTER TABLE cities CHANGE city name VARCHAR(50) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE cities CHANGE name city VARCHAR(50) NOT NULL');
    }
};
