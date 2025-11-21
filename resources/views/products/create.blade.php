<x-layouts.app title="Crear Producto">
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Crear Producto</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Agregar nuevo producto al inventario</p>
        </div>

        <div class="max-w-2xl">
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Nombre del Producto <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nombre" 
                                   id="nombre"
                                   value="{{ old('nombre') }}"
                                   required
                                   class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nombre') border-red-500 @enderror">
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cantidad de Unidades -->
                            <div>
                                <label for="cantidad_unidades" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Cantidad de Unidades <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="cantidad_unidades" 
                                       id="cantidad_unidades"
                                       value="{{ old('cantidad_unidades', 0) }}"
                                       min="0"
                                       required
                                       class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cantidad_unidades') border-red-500 @enderror">
                                @error('cantidad_unidades')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tipo de Unidad -->
                            <div>
                                <label for="tipo_unidad" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Tipo de Unidad <span class="text-red-500">*</span>
                                </label>
                                <select name="tipo_unidad" 
                                        id="tipo_unidad"
                                        required
                                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tipo_unidad') border-red-500 @enderror">
                                    <option value="mg" {{ old('tipo_unidad') == 'mg' ? 'selected' : '' }}>Miligramos (mg)</option>
                                    <option value="ml" {{ old('tipo_unidad') == 'ml' ? 'selected' : '' }}>Mililitros (ml)</option>
                                </select>
                                @error('tipo_unidad')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Peso por Unidad -->
                            <div>
                                <label for="peso_por_unidad" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Cantidad por Unidad <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="peso_por_unidad" 
                                       id="peso_por_unidad"
                                       value="{{ old('peso_por_unidad', 0) }}"
                                       min="0"
                                       step="0.01"
                                       required
                                       class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('peso_por_unidad') border-red-500 @enderror">
                                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Se medirá en mg o ml según el tipo seleccionado</p>
                                @error('peso_por_unidad')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Precio por Unidad -->
                            <div>
                                <label for="precio_unitario" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Precio por Unidad ($) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="precio_unitario" 
                                       id="precio_unitario"
                                       value="{{ old('precio_unitario', 0) }}"
                                       min="0"
                                       step="0.01"
                                       required
                                       class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('precio_unitario') border-red-500 @enderror">
                                @error('precio_unitario')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Fecha de Vencimiento -->
                        <div>
                            <label for="fecha_vencimiento" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Fecha de Vencimiento <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="fecha_vencimiento" 
                                   id="fecha_vencimiento"
                                   value="{{ old('fecha_vencimiento') }}"
                                   required
                                   class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('fecha_vencimiento') border-red-500 @enderror">
                            @error('fecha_vencimiento')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-3 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Crear Producto
                            </button>
                            <a href="{{ route('products.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 rounded-lg transition">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>