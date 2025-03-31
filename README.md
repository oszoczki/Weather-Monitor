# WeatherMonitor

## Elérhetőségek

- GitHub: [oszoczki/Weather-Monitor](https://github.com/oszoczki/Weather-Monitor)
- Email: oszoczki@gmail.com
- PhoneNumber: +40753149009
- Author: Oszoczki Richárd

## Részletek

WeatherMonitor egy Laravel alapú időjárás-figyelő alkalmazás, amely lehetővé teszi különböző helyszínek időjárásának automatikus monitorozását és az adatok megjelenítését.

## Funkciók

- Helyszínek kezelése (létrehozás, szerkesztés, törlés)
- Automatikus időjárás-ellenőrzés helyszínenként egyedi ütemezéssel
- Hőmérsékleti adatok tárolása és megjelenítése
- Prometheus-kompatibilis metrikák exportálása
- Reszponzív felhasználói felület
- REST API az adatok lekérdezéséhez

## Telepítés

1. Klónozza le a repository-t:
```bash
git clone https://github.com/yourusername/weathermonitor.git
cd weathermonitor
```

2. Telepítse a függőségeket:
```bash
composer install
```

3. Másolja le a `.env.example` fájlt `.env` néven és állítsa be a környezeti változókat:
```bash
cp .env.example .env
```

4. Generálja le az alkalmazás kulcsát:
```bash
php artisan key:generate
```

5. Futtassa a migrációkat:
```bash
php artisan migrate
```

6. (Opcionális) Töltse fel az adatbázist teszt adatokkal:
```bash
php artisan db:seed
```

## Környezeti változók

A `.env` fájlban a következő változókat kell beállítani:

- `DB_CONNECTION`: Az adatbázis típusa (pl. mysql)
- `DB_HOST`: Az adatbázis szerver címe
- `DB_PORT`: Az adatbázis port száma
- `DB_DATABASE`: Az adatbázis neve
- `DB_USERNAME`: Az adatbázis felhasználónév
- `DB_PASSWORD`: Az adatbázis jelszó

## Használat

### Helyszínek kezelése

A helyszíneket a webes felületen keresztül lehet kezelni. Minden helyszínhez meg kell adni:
- Országot
- Várost
- Cron kifejezést az ellenőrzés gyakoriságához
- Megjelenítés a kezdőoldalon (igen/nem)

### Időjárás ellenőrzése

Az időjárás ellenőrzése automatikusan történik a megadott cron kifejezések alapján. Manuálisan is elindítható:

```bash
php artisan location:check {locationId}
```

### Metrikák

A Prometheus metrikák a `/api/v1/metrics` végponton érhetők el. A következő metrikákat szolgáltatja:

- `weathermonitor_locations_total`: Helyszínek száma
- `weathermonitor_temperature_measurements_total`: Mérések száma
- `weathermonitor_temperature_celsius`: Aktuális hőmérséklet helyszínenként
- `weathermonitor_temperature_average_celsius`: Átlagos hőmérséklet az utolsó 24 órában
- `weathermonitor_temperature_min_celsius`: Minimum hőmérséklet az utolsó 24 órában
- `weathermonitor_temperature_max_celsius`: Maximum hőmérséklet az utolsó 24 órában

### API végpontok

- `GET /api/v1/locations`: Összes helyszín listázása
- `GET /api/v1/locations/{id}`: Egy helyszín részletes adatai
- `GET /api/v1/metrics`: Prometheus metrikák

## Fejlesztés

### Tesztek futtatása

```bash
php artisan test
```

### Kódstílus ellenőrzése

```bash
./vendor/bin/phpcs
```

### Statikus kódelemzés

```bash
./vendor/bin/phpstan analyse
```

## Adatbázis struktúra

### Locations tábla
- `id` - int, auto-increment
- `name` - string, a helyszín neve
- `country_code` - string(2), ISO 3166-1 alpha-2 országkód
- `city` - string, város neve
- `latitude` - decimal(10,8), szélességi fok
- `longitude` - decimal(11,8), hosszúsági fok
- `cron` - string, cron kifejezés
- `show_on_home` - boolean, megjelenítés a kezdőoldalon
- `created_at` - timestamp
- `updated_at` - timestamp

### Temperatures tábla
- `id` - int, auto-increment
- `location_id` - int, foreign key a locations táblára
- `temperature` - decimal(5,2), hőmérséklet Celsius fokban
- `created_at` - timestamp
- `updated_at` - timestamp

## Közreműködés

1. Fork-olja a repository-t
2. Hozzon létre egy új branch-et (`git checkout -b feature/amazing-feature`)
3. Commit-olja a változtatásokat (`git commit -m 'Add some amazing feature'`)
4. Push-olja a branch-et (`git push origin feature/amazing-feature`)
5. Nyisson egy Pull Request-et

## Licensz

MIT License - lásd a [LICENSE](LICENSE) fájlt a részletekért.