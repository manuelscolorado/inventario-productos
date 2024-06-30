<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            $producto->stockid = self::generateStockId();
        });
    }

    private static function generateStockId()
    {
        $stockid = Str::random(10); // Genera un ID de 10 caracteres
        while (self::where('stockid', $stockid)->exists()) {
            $stockid = Str::random(10); // Genera un nuevo ID si el anterior ya existe
        }
        return $stockid;
    }
}
