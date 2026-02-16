<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jugadora extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'dorsal', 'posicio', 'equip_id', 'edat'];

    public function equip(): BelongsTo
    {
        return $this->belongsTo(Equip::class);
    }
}
