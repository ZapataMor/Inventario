<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;

class SaleDetailController extends Controller
{
    public function destroy(SaleDetail $saleDetail)
    {
        DB::beginTransaction();

        try {
            // Guardar datos antes de eliminar
            $cantidad = $saleDetail->cantidad;
            $subtotal = $saleDetail->subtotal;
            $producto = $saleDetail->product;
            $venta = $saleDetail->sale;

            // ⭐ DEVOLVER STOCK AL INVENTARIO
            $producto->cantidad_unidades += $cantidad;
            $producto->save();

            // Actualizar el total de la venta
            $venta->total -= $subtotal;
            $venta->save();

            // Eliminar el detalle
            $saleDetail->delete();

            DB::commit();

            return back()->with('success', "Detalle eliminado. Se han devuelto {$cantidad} unidades de '{$producto->nombre}' al inventario.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar el detalle: ' . $e->getMessage());
        }
    }
}