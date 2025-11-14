<?php

namespace App\Observers;

use App\Models\SaleDetail;

class SaleDetailObserver
{
    /**
     * Handle the SaleDetail "created" event.
     */
    public function created(SaleDetail $saleDetail): void
    {
        $producto = $saleDetail->product;
        $producto->cantidad_unidades -= $saleDetail->cantidad;
        $producto->save();
    }

    /**
     * Handle the SaleDetail "updated" event.
     */
    public function updated(SaleDetail $saleDetail): void
    {
        //
    }

    /**
     * Handle the SaleDetail "deleted" event.
     */
    public function deleted(SaleDetail $saleDetail): void
    {
        $producto = $saleDetail->product;
        $producto->cantidad_unidades += $saleDetail->cantidad;
        $producto->save();

        // Actualizar el total de la venta
        $venta = $saleDetail->sale;
        $venta->total -= $saleDetail->subtotal;
        $venta->save();
    }

    /**
     * Handle the SaleDetail "restored" event.
     */
    public function restored(SaleDetail $saleDetail): void
    {
        //
    }

    /**
     * Handle the SaleDetail "force deleted" event.
     */
    public function forceDeleted(SaleDetail $saleDetail): void
    {
        //
    }
}
