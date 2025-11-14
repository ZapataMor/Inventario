<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all(); 
        return view('products.index', compact('productos'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad_unidades' => 'required|integer|min:0',
            'fecha_vencimiento' => 'required|date',
            'peso_por_unidad' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad_unidades' => 'required|integer|min:0',
            'fecha_vencimiento' => 'required|date',
            'peso_por_unidad' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado.');
    }
}
