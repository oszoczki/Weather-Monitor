<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Temperature Model
 *
 * Ez a modell kezeli a hőmérsékleti méréseket a különböző helyszíneken.
 * Minden mérés egy adott helyszínhez tartozik és tartalmazza a mért hőmérsékletet.
 *
 * @property int $id
 * @property int $location_id A helyszín azonosítója, amihez a mérés tartozik
 * @property float $temperature A mért hőmérséklet Celsius fokban
 * @property \Carbon\Carbon $created_at A mérés időpontja
 * @property \Carbon\Carbon $updated_at A rekord utolsó módosításának időpontja
 *
 * @property-read \App\Models\Location $location A helyszín, ahol a mérés történt
 */
class Temperature extends Model
{
    /**
     * A tömbben tömegesen feltölthető mezők.
     *
     * @var array<string>
     */
    protected $fillable = [
        'location_id',
        'temperature',
    ];

    /**
     * A modell típuskonverziói.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'temperature' => 'decimal:2',
    ];

    /**
     * A méréshez tartozó helyszín kapcsolata.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
