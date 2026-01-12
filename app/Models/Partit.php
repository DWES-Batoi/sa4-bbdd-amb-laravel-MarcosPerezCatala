<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = ['local_id', 'visitant_id', 'data_partit', 'gols_local', 'gols_visitant'];

    protected $casts = [
        'data_partit' => 'datetime',
    ];

    // Relación Equipo Local
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    // Relación Equipo Visitante
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }
}