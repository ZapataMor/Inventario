<x-layouts.app title="Productos">
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Productos</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Gestiona el inventario de productos</p>
            
            <div class="mt-4 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
                <a href="{{ route('products.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nuevo Producto
                </a>

                <!-- Search Bar -->
                <form method="GET" action="{{ route('products.index') }}" class="w-full sm:w-auto">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Buscar productos..." 
                               class="w-full sm:w-64 pl-10 pr-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-800 dark:text-green-200">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Alerta de productos por vencer -->
        @php
            $productosPorVencer = collect();
            if (isset($productos) && $productos->count() > 0) {
                $productosPorVencer = $productos->filter(function($product) {
                    $vencimiento = \Carbon\Carbon::parse($product->fecha_vencimiento);
                    $diasRestantes = now()->diffInDays($vencimiento, false);
                    return $diasRestantes >= 0 && $diasRestantes < 30;
                });
            }
            
            $productosVencidos = collect();
            if (isset($productos) && $productos->count() > 0) {
                $productosVencidos = $productos->filter(function($product) {
                    $vencimiento = \Carbon\Carbon::parse($product->fecha_vencimiento);
                    return now()->diffInDays($vencimiento, false) < 0;
                });
            }
        @endphp

        @if($productosVencidos->count() > 0)
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-red-800 dark:text-red-400 mb-2">
                            ¡Productos vencidos! ({{ $productosVencidos->count() }})
                        </h3>
                        <div class="space-y-1.5">
                            @foreach($productosVencidos->take(3) as $productoVencido)
                                @php
                                    $vencimiento = \Carbon\Carbon::parse($productoVencido->fecha_vencimiento);
                                    $diasVencido = abs((int)now()->diffInDays($vencimiento, false));
                                @endphp
                                <div class="flex items-center justify-between bg-red-100 dark:bg-red-900/30 rounded px-3 py-2">
                                    <span class="text-sm font-medium text-red-900 dark:text-red-300">{{ $productoVencido->nombre }}</span>
                                    <span class="text-xs text-red-700 dark:text-red-400">Vencido hace {{ $diasVencido }} día{{ $diasVencido != 1 ? 's' : '' }}</span>
                                </div>
                            @endforeach
                            @if($productosVencidos->count() > 3)
                                <p class="text-xs text-red-700 dark:text-red-400 italic pl-3">...y {{ $productosVencidos->count() - 3 }} producto(s) más</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($productosPorVencer->count() > 0)
            <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-yellow-800 dark:text-yellow-400 mb-2">
                            Productos por vencer ({{ $productosPorVencer->count() }})
                        </h3>
                        <div class="space-y-1.5">
                            @foreach($productosPorVencer->take(3) as $productoPorVencer)
                                @php
                                    $vencimiento = \Carbon\Carbon::parse($productoPorVencer->fecha_vencimiento);
                                    $diasRestantes = (int)now()->diffInDays($vencimiento, false);
                                @endphp
                                <div class="flex items-center justify-between bg-yellow-100 dark:bg-yellow-900/30 rounded px-3 py-2">
                                    <span class="text-sm font-medium text-yellow-900 dark:text-yellow-300">{{ $productoPorVencer->nombre }}</span>
                                    <span class="text-xs text-yellow-700 dark:text-yellow-400">
                                        Vence en {{ $diasRestantes }} día{{ $diasRestantes != 1 ? 's' : '' }} ({{ $vencimiento->format('d/m/Y') }})
                                    </span>
                                </div>
                            @endforeach
                            @if($productosPorVencer->count() > 3)
                                <p class="text-xs text-yellow-700 dark:text-yellow-400 italic pl-3">...y {{ $productosPorVencer->count() - 3 }} producto(s) más</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($productos->isEmpty())
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-12 text-center">
                @if(request('search'))
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-2">No se encontraron productos</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">No hay resultados para "{{ request('search') }}"</p>
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        Ver todos los productos
                    </a>
                @else
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-2">No hay productos registrados</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">Comienza agregando tu primer producto al inventario</p>
                    <a href="{{ route('products.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Crear Producto
                    </a>
                @endif
            </div>
        @else
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Cantidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Peso/Unidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Vencimiento</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach($productos as $product)
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                                    <td class="px-6 py-4 text-sm text-zinc-900 dark:text-white">{{ $product->nombre }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($product->cantidad_unidades > 10) bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400
                                            @elseif($product->cantidad_unidades > 0) bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400
                                            @else bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400
                                            @endif">
                                            {{ $product->cantidad_unidades }} unidades
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">{{ number_format($product->peso_por_unidad, 2) }} kg</td>
                                    <td class="px-6 py-4 text-sm">
                                        @php
                                            $vencimiento = \Carbon\Carbon::parse($product->fecha_vencimiento);
                                            $diasRestantes = (int)now()->diffInDays($vencimiento, false);
                                        @endphp
                                        <span class="@if($diasRestantes < 0) text-red-600 dark:text-red-400 @elseif($diasRestantes < 30) text-yellow-600 dark:text-yellow-400 @else text-zinc-600 dark:text-zinc-400 @endif">
                                            {{ $vencimiento->format('d/m/Y') }}
                                            @if($diasRestantes < 0)
                                                (Vencido)
                                            @elseif($diasRestantes < 30)
                                                ({{ $diasRestantes }} día{{ $diasRestantes != 1 ? 's' : '' }})
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('products.show', $product) }}" 
                                               class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Ver
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" 
                                               class="inline-flex items-center px-3 py-1.5 text-sm text-zinc-600 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Editar
                                            </a>
                                            <form method="POST" action="{{ route('products.destroy', $product) }}" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este producto?')"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $productos->appends(['search' => request('search')])->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>