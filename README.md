# Megyék / Városok nyilvántartó

Laravel gyakorló feladat: megyék és városok CRUD nyilvántartása, a "Laravel gyorstalpaló" videósorozat módszertana alapján.

## Adatbázis

- **County** (`counties` tábla): `id`, `name`, `badge` (megye címere, kép URL, opcionális)
- **City** (`cities` tábla): `id`, `id_county`, `name`, `zip_code`, `population`

A két tábla között 1:N kapcsolat van (`County` `hasMany` `City`, `City` `belongsTo` `County`), valódi adatbázis-szintű foreign key constraint-tel védve.

## Funkciók

- Teljes CRUD mindkét entitáshoz (migráció, model, controller, seeder, listázó/létrehozó/szerkesztő nézet)
- Listázó oldalak keresővel (megye/város név szerint)
- Városok listája lapozva, megye szerint szűrhető
- Megyék listáján megjelenik az összlakosság (a hozzá tartozó városok lakosságának összege) és a megye címere
- Laravel Breeze alapú autentikáció: a listázás/megjelenítés publikus, a létrehozás/szerkesztés/törlés bejelentkezést igényel

## Telepítés

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
# .env-ben állítsd be a DB_* adatokat egy üres adatbázisra
php artisan migrate
php artisan db:seed
```

A seeder a valódi magyar megye-/településlistát tölti be (`database/seeders/data/*.json`), a `population` mező viszont **demo/placeholder adat** (véletlenszerűen generált, nem valódi KSH statisztika), mivel megbízható, településenkénti népességi adat nem állt rendelkezésre a feladat elkészítésekor.

## Teszt bejelentkezés

A seeder létrehoz egy teszt felhasználót:

- Email: `test@example.com`
- Jelszó: `password`

## Indítás

```bash
php artisan serve
```
