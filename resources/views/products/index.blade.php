<x-layouts.app title="Productos">
    <flux:header>
        <flux:heading size="xl">Productos</flux:heading>
        <flux:subheading>Gestiona el inventario de productos</flux:subheading>

        <flux:spacer />

        <flux:button variant="primary" :href="route('products.create')" icon="plus">
            Nuevo Producto
        </flux:button>
    </flux:header>

    @if(session('success'))
        <flux:callout variant="success" icon="check-circle" class="mb-6">
            {{ session('success') }}
        </flux:callout>
    @endif

    @if($productos->isEmpty())
        <flux:card class="mt-6">
            <div class="text-center py-12">
                <flux:heading size="lg" class="mb-2">No hay productos registrados</flux:heading>
                <flux:subheading>Comienza agregando tu primer producto al inventario</flux:subheading>
                <flux:button variant="primary" :href="route('products.create')" icon="plus" class="mt-4">
                    Crear Producto
                </flux:button>
            </div>
        </flux:card>
    @else
        <flux:table class="mt-6">
            <flux:columns>
                <flux:column>Nombre</flux:column>
                <flux:column>Cantidad</flux:column>
                <flux:column>Peso/Unidad</flux:column>
                <flux:column>Vencimiento</flux:column>
                <flux:column>Acciones</flux:column>
            </flux:columns>

            <flux:rows>
                @foreach($productos as $producto)
                    <flux:row>
                        <flux:cell>{{ $producto->nombre }}</flux:cell>
                        <flux:cell>
                            <flux:badge :color="$producto->cantidad_unidades > 10 ? 'green' : ($producto->cantidad_unidades > 0 ? 'yellow' : 'red')">
                                {{ $producto->cantidad_unidades }} unidades
                            </flux:badge>
                        </flux:cell>
                        <flux:cell>{{ number_format($producto->peso_por_unidad, 2) }} kg</flux:cell>
                        <flux:cell>
                            @php
                                $vencimiento = \Carbon\Carbon::parse($producto->fecha_vencimiento);
                                $diasRestantes = now()->diffInDays($vencimiento, false);
                            @endphp
                            <span class="@if($diasRestantes < 0) text-red-600 @elseif($diasRestantes < 30) text-yellow-600 @endif">
                                {{ $vencimiento->format('d/m/Y') }}
                                @if($diasRestantes < 0)
                                    (Vencido)
                                @elseif($diasRestantes < 30)
                                    ({{ round($diasRestantes) }} días)
                                @endif
                            </span>
                        </flux:cell>
                        <flux:cell>
                            <div class="flex gap-2">
                                <flux:button variant="ghost" size="sm" :href="route('products.show', $producto)" icon="eye">
                                    Ver
                                </flux:button>
                                <flux:button variant="ghost" size="sm" :href="route('products.edit', $producto)" icon="pencil">
                                    Editar
                                </flux:button>
                                <form method="POST" action="{{ route('products.destroy', $producto) }}" 
                                      onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" variant="danger" size="sm" icon="trash">
                                        Eliminar
                                    </flux:button>
                                </form>
                            </div>
                        </flux:cell>
                    </flux:row>
                @endforeach
            </flux:rows>
        </flux:table>
    @endif
</x-layouts.app>