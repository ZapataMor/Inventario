<x-layouts.app title="Detalle de Venta">
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Venta #{{ $sale->id }}</h1>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Detalles completos de la venta</p>
            </div>
            <a href="{{ route('sales.index') }}" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition">
                Volver
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-3 mb-6">
            <!-- Información de la Venta -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Información General</h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Fecha de Venta</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($sale->fecha_venta)->format('d/m/Y H:i:s') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Vendedor</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">
                            {{ $sale->user->name }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Email del Vendedor</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">
                            {{ $sale->user->email }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Resumen Total -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-xl p-6 text-white">
                <h2 class="text-lg font-semibold mb-2">Total de la Venta</h2>
                <p class="text-4xl font-bold">${{ number_format($sale->total, 2) }}</p>
                <p class="text-sm opacity-90 mt-2">{{ $sale->saleDetails->count() }} producto(s)</p>
            </div>

            <!-- Estadísticas -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Estadísticas</h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Unidades</dt>
                        <dd class="mt-1 text-2xl font-bold text-zinc-900 dark:text-white">
                            {{ $sale->saleDetails->sum('cantidad') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Productos Diferentes</dt>
                        <dd class="mt-1 text-2xl font-bold text-zinc-900 dark:text-white">
                            {{ $sale->saleDetails->count() }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Detalles de Productos -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Productos Vendidos</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Contenido</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Precio Unit.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Subtotal</th>
                            @if(auth()->user()->role->nombre === 'admin')
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach($sale->saleDetails as $detail)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                                <td class="px-6 py-4 text-sm text-zinc-900 dark:text-white">
                                    {{ $detail->product->nombre }}
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ $detail->cantidad }} unidades
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ number_format($detail->product->peso_por_unidad, 2) }} {{ $detail->product->tipo_unidad }}
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-900 dark:text-white font-medium">
                                    ${{ number_format($detail->precio_unitario, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                        ${{ number_format($detail->subtotal, 2) }}
                                    </span>
                                </td>
                                @if(auth()->user()->role->nombre === 'admin')
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('sale-details.destroy', $detail) }}" 
                                                onsubmit="return confirm('¿Estás seguro de eliminar este detalle? Se devolverá el stock al inventario.')"
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
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-zinc-50 dark:bg-zinc-900 border-t-2 border-zinc-300 dark:border-zinc-600">
                        <tr>
                            <td colspan="{{ auth()->user()->role->nombre === 'admin' ? 4 : 4 }}" class="px-6 py-4 text-right text-sm font-semibold text-zinc-900 dark:text-white">
                                Total:
                            </td>
                            <td class="px-6 py-4" colspan="2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-base font-bold bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400">
                                    ${{ number_format($sale->total, 2) }}
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>