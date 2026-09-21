<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Seed the cities table from the bundled data/cities.json fixture.
     *
     * Real Hungarian settlement names, zip codes and county assignments are
     * used, but population is demo/placeholder data (there is no reliable
     * per-settlement census figure available here) - villages get a small
     * random population, Budapest's districts get a city-district-sized one.
     */
    public function run(): void
    {
        $cities = json_decode(file_get_contents(__DIR__.'/data/cities.json'), true);

        foreach ($cities as &$city) {
            $city['population'] = Str::contains($city['name'], 'Budapest')
                ? random_int(15000, 70000)
                : random_int(50, 8000);
        }
        unset($city);

        DB::table('cities')->truncate();

        foreach (array_chunk($cities, 500) as $chunk) {
            DB::table('cities')->insert($chunk);
        }
    }
}
