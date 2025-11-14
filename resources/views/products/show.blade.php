<x-layouts.app title="Detalle del Producto">
    <div class="p-6">
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Detalle del Producto</h1>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Información completa del producto</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('products.edit', $product) }}" 
                       class="inline-flex items-center px-4 py-2 border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-zinc-600 hover:bg-zinc-700 text-white rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>
                </div>
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

        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                <!-- Header con información básica -->
                <div class="bg-zinc-50 dark:bg-zinc-900 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">{{ $product->nombre }}</h2>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">Código: #{{ $product->id }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($product->cantidad_unidades > 10) bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400
                                @elseif($product->cantidad_unidades > 0) bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400
                                @else bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400
                                @endif">
                                {{ $product->cantidad_unidades }} unidades
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Información básica -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">Información General</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400">Descripción</label>
                                        <p class="mt-1 text-sm text-zinc-900 dark:text-white">
                                            {{ $product->descripcion ?: 'Sin descripción' }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400">Peso por Unidad</label>
                                            <p class="mt-1 text-sm text-zinc-900 dark:text-white">
                                                {{ number_format($product->peso_por_unidad, 2) }} kg
                                            </p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400">Precio por Unidad</label>
                                            <p class="mt-1 text-sm text-zinc-900 dark:text-white">
                                                ${{ number_format($product->precio_por_unidad, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información de inventario -->
                            <div>
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">Inventario</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400">Cantidad Total</label>
                                        <p class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-white">
                                            {{ $product->cantidad_unidades }} unidades
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400">Peso Total</label>
                                        <p class="mt-1 text-lg text-zinc-900 dark:text-white">
                                            {{ number_format($product->cantidad_unidades * $product->peso_por_unidad, 2) }} kg
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400">Valor Total en Inventario</label>
                                        <p class="mt-1 text-lg text-blue-600 dark:text-blue-400 font-semibold">
                                            ${{ number_format($product->cantidad_unidades * $product->precio_por_unidad, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información adicional -->
                        <div class="space-y-6">
                            <!-- Estado de vencimiento -->
                            <div>
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">Fecha de Vencimiento</h3>
                                
                                @php
                                    $vencimiento = \Carbon\Carbon::parse($product->fecha_vencimiento);
                                    $diasRestantes = now()->diffInDays($vencimiento, false);
                                    $esVencido = $diasRestantes < 0;
                                    $estaPorVencer = $diasRestantes >= 0 && $diasRestantes < 30;
                                @endphp

                                <div class="p-4 rounded-lg border 
                                    @if($esVencido) border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20
                                    @elseif($estaPorVencer) border-yellow-200 dark:border-yellow-800 bg-yellow-50 dark:bg-yellow-900/20
                                    @else border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900/20
                                    @endif">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($esVencido)
                                                <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                                </svg>
                                            @elseif($estaPorVencer)
                                                <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @else
                                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium 
                                                @if($esVencido) text-red-800 dark:text-red-400
                                                @elseif($estaPorVencer) text-yellow-800 dark:text-yellow-400
                                                @else text-green-800 dark:text-green-400
                                                @endif">
                                                {{ $vencimiento->format('d/m/Y') }}
                                            </p>
                                            <p class="text-sm 
                                                @if($esVencido) text-red-700 dark:text-red-300
                                                @elseif($estaPorVencer) text-yellow-700 dark:text-yellow-300
                                                @else text-green-700 dark:text-green-300
                                                @endif">
                                                @if($esVencido)
                                                    Producto vencido hace {{ abs(round($diasRestantes)) }} días
                                                @elseif($estaPorVencer)
                                                    Vence en {{ round($diasRestantes) }} días
                                                @else
                                                    Vence en {{ round($diasRestantes) }} días
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información de registro -->
                            <div>
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">Información de Registro</h3>
                                
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-zinc-500 dark:text-zinc-400">Creado el:</span>
                                        <span class="text-zinc-900 dark:text-white">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-zinc-500 dark:text-zinc-400">Última actualización:</span>
                                        <span class="text-zinc-900 dark:text-white">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    @if($product->fecha_vencimiento)
                                    <div class="flex justify-between">
                                        <span class="text-zinc-500 dark:text-zinc-400">Días hasta vencimiento:</span>
                                        <span class="font-medium 
                                            @if($esVencido) text-red-600 dark:text-red-400
                                            @elseif($estaPorVencer) text-yellow-600 dark:text-yellow-400
                                            @else text-green-600 dark:text-green-400
                                            @endif">
                                            {{ round($diasRestantes) }} días
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Acciones rápidas -->
                            <div>
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-4">Acciones</h3>
                                
                                <div class="space-y-2">
                                    <a href="{{ route('products.edit', $product) }}" 
                                       class="w-full flex items-center justify-center px-4 py-2 border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 rounded-lg transition">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar Producto
                                    </a>
                                    
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full flex items-center justify-center px-4 py-2 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Eliminar Producto
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>