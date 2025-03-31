<?php
namespace App\Models;

use App\Rules\CronExpression;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Location Model
 *
 * Ez a modell kezeli a helyszíneket, ahol időjárási adatokat gyűjtünk.
 * Minden helyszínhez tartozik egy cron kifejezés, ami meghatározza,
 * hogy milyen gyakran kell ellenőrizni az időjárást.
 *
 * @property int $id
 * @property string $name A helyszín neve
 * @property string $country_code Az ország kétbetűs kódja (ISO 3166-1 alpha-2)
 * @property string $city A város neve
 * @property float $latitude A helyszín szélességi foka (-90 és 90 között)
 * @property float $longitude A helyszín hosszúsági foka (-180 és 180 között)
 * @property string $cron A cron kifejezés az időjárás ellenőrzésének gyakoriságához
 * @property \Carbon\Carbon $created_at A rekord létrehozásának időpontja
 * @property \Carbon\Carbon $updated_at A rekord utolsó módosításának időpontja
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Temperature[] $temperatures
 * A helyszínhez tartozó hőmérsékleti mérések
 */
class Location extends Model
{
    use HasFactory;

    /**
     * A tömbben tömegesen feltölthető mezők.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'country_code',
        'city',
        'latitude',
        'longitude',
        'cron',
        'show_on_home',
    ];

    protected $casts = [
        'latitude'     => 'float',
        'longitude'    => 'float',
        'show_on_home' => 'boolean',
    ];

    /**
     * A helyszínhez tartozó hőmérsékleti mérések kapcsolata.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temperatures(): HasMany
    {
        return $this->hasMany(Temperature::class);
    }

    /**
     * A modell validációs szabályai.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string', 'max:2'],
            'city'         => ['required', 'string', 'max:255'],
            'latitude'     => ['required', 'numeric', 'between:-90,90'],
            'longitude'    => ['required', 'numeric', 'between:-180,180'],
            'cron'         => ['required', 'string', new CronExpression],
            'show_on_home' => ['required', 'boolean'],
        ];
    }
}
