<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder
{
    /**
     * Seed the counties table from the bundled data/counties.json fixture.
     *
     * The badge (coat of arms) column is intentionally left empty here -
     * it can be filled in later per county (e.g. with an image path/URL).
     */
    public function run(): void
    {
        $counties = json_decode(file_get_contents(__DIR__.'/data/counties.json'), true);

        DB::table('counties')->truncate();
        DB::table('counties')->insert($counties);
    }
}
