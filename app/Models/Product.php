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
        'creado_por',
        'actualizado_por',
    ];

    protected function casts(): array
    {
        return [
            'fecha_vencimiento' => 'date',
            'peso_por_unidad' => 'decimal:2',
        ];
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}