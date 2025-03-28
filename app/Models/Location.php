<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'country',
        'city',
        'latitude',
        'longitude',
        'cron',
    ];

    protected $casts = [
        'latitude'  => 'decimal:8',
        'longitude' => 'decimal:8',
        'cron'      => 'integer',
    ];

    public function temperatures(): HasMany
    {
        return $this->hasMany(Temperature::class);
    }
}
