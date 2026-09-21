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
        // Cities already reference id_county 1, 2 and 3, but these counties
        // were never inserted - add them back with the ids the cities expect.
        DB::table('counties')->insert([
            ['id' => 1, 'name' => 'Budapest'],
            ['id' => 2, 'name' => 'Bács-Kiskun'],
            ['id' => 3, 'name' => 'Baranya'],
        ]);

        // Unused rows with no cities attached (test/duplicate data).
        DB::table('counties')->whereIn('id', [44, 45, 46])->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('counties')->whereIn('id', [1, 2, 3])->delete();

        DB::table('counties')->insert([
            ['id' => 44, 'name' => 'Aba'],
            ['id' => 45, 'name' => 'Baranya'],
            ['id' => 46, 'name' => 'Szepes'],
        ]);
    }
};
