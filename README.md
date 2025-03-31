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

7. Indítsa el a fejlesztői szervert:
```bash
php artisan serve
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

## CI/CD

A projekt GitHub Actions-t használ a folyamatos integrációhoz. Minden push és pull request esetén automatikusan lefutnak:

- PHPStan statikus kód elemzés
- PHPCS kód stílus ellenőrzés
- Unit tesztek futtatása
- Kód lefedettség mérése és jelentés

A CI folyamat konfigurációja a `.github/workflows/ci.yml` fájlban található.

### Release folyamat

A projekt automatikusan létrehoz release-eket amikor új tag-eket pusholunk. A release folyamat a következőket végzi:

1. Létrehoz egy új release-t a tag alapján
2. Frissíti a CHANGELOG.md fájlt az új verzióval
3. Commitolja a CHANGELOG.md változtatásokat

Új release létrehozásához:

```bash
git tag -a v1.0.0 -m "Release version 1.0.0"
git push origin v1.0.0
```

A release folyamat konfigurációja a `.github/workflows/release.yml` fájlban található.

## Hibakezelés és naplózás

- Minden művelet naplózásra kerül a `storage/logs` könyvtárban
- Hibák esetén a rendszer automatikusan értesíti a rendszergazdát
- A naplófájlok napi rotációval rendelkeznek

## Fejlesztés

1. Forkolja a repository-t
2. Hozzon létre egy feature branch-et (`git checkout -b feature/amazing-feature`)
3. Commitolja a változtatásokat (`git commit -m 'Add some amazing feature'`)
4. Pusholja a branch-et (`git push origin feature/amazing-feature`)
5. Nyisson egy Pull Request-et

## Licensz

MIT License - lásd a [LICENSE](LICENSE) fájlt a részletekért.