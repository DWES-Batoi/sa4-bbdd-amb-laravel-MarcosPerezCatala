<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model JUGADORA
 */
class Jugadora extends Model
{
    // Opcional si no usas Factories, pero recomendable dejarlo por si acaso
    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente.
     *
     * @var string[]
     */
    protected $fillable = ['nom', 'dorsal', 'posicio', 'equip_id'];

    /**
     * Relación: Una jugadora pertenece a un equipo.
     * * @return BelongsTo
     */
    public function equip(): BelongsTo
    {
        return $this->belongsTo(Equip::class);
    }
}