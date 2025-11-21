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
        $ventas = Sale::with('user')->latest()->get();
        return view('sales.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Product::where('cantidad_unidades', '>', 0)->get();
        return view('sales.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:products,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Validar stock disponible antes de procesar
            foreach ($request->productos as $item) {
                $producto = Product::find($item['id']);
                
                if ($producto->cantidad_unidades < $item['cantidad']) {
                    DB::rollBack();
                    return back()
                        ->withInput()
                        ->with('error', "Stock insuficiente para el producto '{$producto->nombre}'. Disponible: {$producto->cantidad_unidades}, Solicitado: {$item['cantidad']}");
                }
            }

            // Crear la venta
            $venta = Sale::create([
                'user_id' => auth()->id(),
                'fecha_venta' => now(),
                'total' => 0
            ]);

            $total = 0;

            // Procesar cada producto
            foreach ($request->productos as $item) {
                $producto = Product::find($item['id']);

                // Calcular subtotal con el precio
                $subtotal = $producto->precio_unitario * $item['cantidad'];
                $total += $subtotal;

                // Crear detalle de venta
                SaleDetail::create([
                    'sale_id' => $venta->id,
                    'product_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio_unitario,
                    'subtotal' => $subtotal
                ]);

                // Descuento de inventario
                $producto->cantidad_unidades -= $item['cantidad'];
                $producto->save();
            }

            // Actualizar total de la venta
            $venta->total = $total;
            $venta->save();

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', 'Venta registrada correctamente. Total: $' . number_format($total, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {
        $sale->load('saleDetails.product', 'user');
        return view('sales.show', compact('sale'));
    }
}