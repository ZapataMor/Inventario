<x-layouts.app title="Usuarios">
    <flux:header>
        <flux:heading size="xl">Usuarios</flux:heading>
        <flux:subheading>Gestiona los usuarios del sistema</flux:subheading>

        <flux:spacer />

        <flux:button variant="primary" :href="route('users.create')" icon="plus">
            Nuevo Usuario
        </flux:button>
    </flux:header>

    @if(session('success'))
        <flux:callout variant="success" icon="check-circle" class="mb-6">
            {{ session('success') }}
        </flux:callout>
    @endif

    <flux:table class="mt-6">
        <flux:columns>
            <flux:column>ID</flux:column>
            <flux:column>Nombre</flux:column>
            <flux:column>Email</flux:column>
            <flux:column>Fecha de Registro</flux:column>
            <flux:column>Acciones</flux:column>
        </flux:columns>

        <flux:rows>
            @foreach($users as $user)
                <flux:row>
                    <flux:cell>#{{ $user->id }}</flux:cell>
                    <flux:cell>{{ $user->name }}</flux:cell>
                    <flux:cell>{{ $user->email }}</flux:cell>
                    <flux:cell>{{ $user->created_at->format('d/m/Y') }}</flux:cell>
                    <flux:cell>
                        <div class="flex gap-2">
                            <flux:button variant="ghost" size="sm" :href="route('users.show', $user)" icon="eye">
                                Ver
                            </flux:button>
                            <flux:button variant="ghost" size="sm" :href="route('users.edit', $user)" icon="pencil">
                                Editar
                            </flux:button>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}" 
                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" variant="danger" size="sm" icon="trash">
                                        Eliminar
                                    </flux:button>
                                </form>
                            @endif
                        </div>
                    </flux:cell>
                </flux:row>
            @endforeach
        </flux:rows>
    </flux:table>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</x-layouts.app>