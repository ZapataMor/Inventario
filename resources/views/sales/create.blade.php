<x-layouts.app title="Registrar Venta">
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Registrar Nueva Venta</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Selecciona los productos y cantidades a vender</p>
        </div>

        <div class="max-w-4xl bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <form method="POST" action="{{ route('sales.store') }}" x-data="saleForm()">
                @csrf

                <div class="space-y-6">
                    <!-- Productos Seleccionados -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Productos</h2>
                            <button type="button" 
                                    @click="addProduct()"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Agregar Producto
                            </button>
                        </div>

                        <div class="space-y-3">
                            <template x-for="(item, index) in products" :key="index">
                                <div class="flex gap-3 items-start p-4 bg-zinc-50 dark:bg-zinc-900/50 rounded-lg">
                                    <div class="flex-1">
                                        <label :for="'product_' + index" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                            Producto
                                        </label>
                                        <select 
                                            :name="'productos[' + index + '][id]'" 
                                            :id="'product_' + index"
                                            x-model="item.id"
                                            @change="updateProductInfo(index)"
                                            required
                                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Selecciona un producto</option>
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->id }}" 
                                                        data-stock="{{ $producto->cantidad_unidades }}"
                                                        data-peso="{{ $producto->peso_por_unidad }}">
                                                    {{ $producto->nombre }} (Stock: {{ $producto->cantidad_unidades }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <p x-show="item.stock > 0" class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                                            Stock disponible: <span x-text="item.stock"></span> unidades | 
                                            Peso: <span x-text="item.peso"></span> kg/unidad
                                        </p>
                                    </div>

                                    <div class="w-32">
                                        <label :for="'cantidad_' + index" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                            Cantidad
                                        </label>
                                        <input 
                                            type="number" 
                                            :name="'productos[' + index + '][cantidad]'" 
                                            :id="'cantidad_' + index"
                                            x-model="item.cantidad"
                                            @input="calculateTotal()"
                                            required
                                            min="1"
                                            :max="item.stock"
                                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div class="w-32">
                                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                            Subtotal
                                        </label>
                                        <div class="px-4 py-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg text-sm text-zinc-900 dark:text-white">
                                            <span x-text="(item.peso * item.cantidad).toFixed(2)"></span> kg
                                        </div>
                                    </div>

                                    <button type="button" 
                                            @click="removeProduct(index)"
                                            class="mt-7 p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <div x-show="products.length === 0" class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                                No hay productos agregados. Haz clic en "Agregar Producto" para comenzar.
                            </div>
                        </div>

                        @error('productos')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total -->
                    <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold text-zinc-900 dark:text-white">Total:</span>
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                <span x-text="total.toFixed(2)"></span> kg
                            </span>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <a href="{{ route('sales.index') }}" 
                           class="px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition">
                            Cancelar
                        </a>
                        <button type="submit" 
                                :disabled="products.length === 0"
                                :class="products.length === 0 ? 'opacity-50 cursor-not-allowed' : ''"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                            Registrar Venta
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function saleForm() {
            return {
                products: [],
                total: 0,

                addProduct() {
                    this.products.push({
                        id: '',
                        cantidad: 1,
                        stock: 0,
                        peso: 0
                    });
                },

                removeProduct(index) {
                    this.products.splice(index, 1);
                    this.calculateTotal();
                },

                updateProductInfo(index) {
                    const select = document.querySelector(`select[name="productos[${index}][id]"]`);
                    const option = select.options[select.selectedIndex];
                    
                    if (option.value) {
                        this.products[index].stock = parseInt(option.dataset.stock);
                        this.products[index].peso = parseFloat(option.dataset.peso);
                        this.calculateTotal();
                    }
                },

                calculateTotal() {
                    this.total = this.products.reduce((sum, item) => {
                        return sum + (item.peso * item.cantidad);
                    }, 0);
                }
            }
        }
    </script>
</x-layouts.app>