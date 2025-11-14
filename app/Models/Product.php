<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad_unidades',
        'fecha_vencimiento',
        'peso_por_unidad',
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
