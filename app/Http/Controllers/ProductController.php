<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::with(['createdBy', 'updatedBy'])->latest()->get(); 
        return view('products.index', compact('productos'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cantidad_unidades' => 'required|integer|min:0',
            'fecha_vencimiento' => 'required|date|after:today',
            'peso_por_unidad' => 'required|numeric|min:0',
        ]);

        Product::create([
            'nombre' => $request->nombre,
            'cantidad_unidades' => $request->cantidad_unidades,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'peso_por_unidad' => $request->peso_por_unidad,
            'creado_por' => auth()->id(),
            'actualizado_por' => auth()->id(),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Product $product)
    {
        $product->load(['createdBy', 'updatedBy']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cantidad_unidades' => 'required|integer|min:0',
            'fecha_vencimiento' => 'required|date',
            'peso_por_unidad' => 'required|numeric|min:0',
        ]);

        $product->update([
            'nombre' => $request->nombre,
            'cantidad_unidades' => $request->cantidad_unidades,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'peso_por_unidad' => $request->peso_por_unidad,
            'actualizado_por' => auth()->id(),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}