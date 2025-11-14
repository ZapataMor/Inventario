<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $ventas = Sale::with('user')->get();
        return view('sales.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Product::all();
        return view('sales.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:products,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            $venta = Sale::create([
                'user_id' => auth()->id(),
                'fecha' => now(),
                'total' => 0
            ]);

            $total = 0;

            foreach ($request->productos as $item) {

                $producto = Product::find($item['id']);

                $subtotal = $producto->peso_por_unidad * $item['cantidad'];
                $total += $subtotal;

                SaleDetail::create([
                    'sale_id' => $venta->id,
                    'product_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'subtotal' => $subtotal
                ]);

                // Restar inventario
                $producto->cantidad_unidades -= $item['cantidad'];
                $producto->save();
            }

            $venta->total = $total;
            $venta->save();

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', 'Venta registrada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {
        $sale->load('saleDetails.product', 'user');
        return view('sales.show', compact('sale'));
    }
}
