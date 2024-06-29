<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'stockid', 'nombre', 'descripcion', 'cantidad', 'precio', 'costo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
