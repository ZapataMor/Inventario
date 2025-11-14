<x-layouts.app title="Editar Producto">
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Editar Producto</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Actualiza la información del producto</p>
        </div>

        <div class="max-w-2xl bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <form method="POST" action="{{ route('products.update', $product) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Nombre del Producto <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nombre"
                            name="nombre" 
                            value="{{ old('nombre', $product->nombre) }}"
                            required
                            maxlength="100"
                            placeholder="Ej: Paracetamol 500mg"
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        @error('nombre')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cantidad de Unidades -->
                    <div>
                        <label for="cantidad_unidades" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Cantidad de Unidades <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="cantidad_unidades"
                            name="cantidad_unidades" 
                            value="{{ old('cantidad_unidades', $product->cantidad_unidades) }}"
                            required
                            min="0"
                            placeholder="Ej: 100"
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        @error('cantidad_unidades')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Vencimiento -->
                    <div>
                        <label for="fecha_vencimiento" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Fecha de Vencimiento <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="fecha_vencimiento"
                            name="fecha_vencimiento" 
                            value="{{ old('fecha_vencimiento', $product->fecha_vencimiento) }}"
                            required
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        @error('fecha_vencimiento')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Peso por Unidad -->
                    <div>
                        <label for="peso_por_unidad" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Peso por Unidad (kg) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="peso_por_unidad"
                            name="peso_por_unidad" 
                            value="{{ old('peso_por_unidad', $product->peso_por_unidad) }}"
                            required
                            min="0"
                            step="0.01"
                            placeholder="Ej: 0.5"
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        @error('peso_por_unidad')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Información Adicional -->
                    <div class="bg-zinc-50 dark:bg-zinc-900/50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Información de Auditoría</h3>
                        <div class="space-y-1 text-sm text-zinc-600 dark:text-zinc-400">
                            <p><span class="font-medium">Creado por:</span> {{ $product->createdBy->name ?? 'N/A' }}</p>
                            <p><span class="font-medium">Fecha de creación:</span> {{ $product->created_at->format('d/m/Y H:i') }}</p>
                            @if($product->updatedBy)
                                <p><span class="font-medium">Última actualización por:</span> {{ $product->updatedBy->name }}</p>
                                <p><span class="font-medium">Fecha de actualización:</span> {{ $product->updated_at->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <a href="{{ route('products.index') }}" 
                           class="px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                            Actualizar Producto
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>