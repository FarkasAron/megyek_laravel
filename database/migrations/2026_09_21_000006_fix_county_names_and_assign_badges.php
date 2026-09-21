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
        // "Szepes" is a historical county (now in Slovakia), not a modern
        // Hungarian megye - but its cities (Tatabánya, Tata, Ács, ...) are
        // real Komárom-Esztergom towns, so the name was simply wrong.
        DB::table('counties')->where('name', 'Szepes')->update(['name' => 'Komárom-Esztergom']);

        // Modern official name since the 2020 county merger.
        DB::table('counties')->where('name', 'Csongrád')->update(['name' => 'Csongrád-Csanád']);

        $badges = [
            'Bács-Kiskun' => 'images/badges/bacs-kiskun.jpg',
            'Baranya' => 'images/badges/baranya.jpg',
            'Békés' => 'images/badges/bekes.jpg',
            'Borsod-Abaúj-Zemplén' => 'images/badges/borsod-abauj-zemplen.jpg',
            'Csongrád-Csanád' => 'images/badges/csongrad-csanad.jpg',
            'Fejér' => 'images/badges/fejer.jpg',
            'Győr-Moson-Sopron' => 'images/badges/gyor-moson-sopron.jpg',
            'Hajdú-Bihar' => 'images/badges/hajdu-bihar.jpg',
            'Heves' => 'images/badges/heves.jpg',
            'Jász-Nagykun-Szolnok' => 'images/badges/jasz-nagykun-szolnok.jpg',
            'Komárom-Esztergom' => 'images/badges/komarom-esztergom.jpg',
            'Nógrád' => 'images/badges/nograd.jpg',
            'Pest' => 'images/badges/pest.jpg',
            'Somogy' => 'images/badges/somogy.jpg',
            'Szabolcs-Szatmár-Bereg' => 'images/badges/szabolcs-szatmar-bereg.jpg',
            'Tolna' => 'images/badges/tolna.jpg',
            'Vas' => 'images/badges/vas.jpg',
            'Veszprém' => 'images/badges/veszprem.jpg',
            'Zala' => 'images/badges/zala.jpg',
        ];

        foreach ($badges as $name => $badge) {
            DB::table('counties')->where('name', $name)->update(['badge' => $badge]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('counties')->whereNotNull('badge')->update(['badge' => null]);
        DB::table('counties')->where('name', 'Csongrád-Csanád')->update(['name' => 'Csongrád']);
        DB::table('counties')->where('name', 'Komárom-Esztergom')->update(['name' => 'Szepes']);
    }
};
