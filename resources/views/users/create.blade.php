<x-layouts.app title="Crear Usuario">
    <flux:header>
        <flux:heading size="xl">Crear Usuario</flux:heading>
        <flux:subheading>Agrega un nuevo usuario al sistema</flux:subheading>
    </flux:header>

    <flux:card class="mt-6 max-w-2xl">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="space-y-6">
                <flux:input 
                    name="name" 
                    label="Nombre Completo"
                    placeholder="Juan Pérez"
                    :value="old('name')"
                    required
                />

                <flux:input 
                    name="email" 
                    type="email"
                    label="Correo Electrónico"
                    placeholder="juan@example.com"
                    :value="old('email')"
                    required
                />

                <flux:input 
                    name="password" 
                    type="password"
                    label="Contraseña"
                    placeholder="Mínimo 6 caracteres"
                    required
                />

                <div class="flex gap-3 justify-end mt-6">
                    <flux:button variant="ghost" :href="route('users.index')">
                        Cancelar
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Crear Usuario
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:card>
</x-layouts.app>