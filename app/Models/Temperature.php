<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temperature extends Model
{
    protected $fillable = [
        'location_id',
        'temperature',
    ];

    protected $casts = [
        'temperature' => 'decimal:2',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
