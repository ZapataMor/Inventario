<x-layouts.app title="Editar Usuario">
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Editar Usuario</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Actualiza la información del usuario</p>
        </div>

        <div class="max-w-2xl bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Nombre Completo <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name"
                            name="name" 
                            value="{{ old('name', $user->name) }}"
                            required
                            maxlength="255"
                            placeholder="Juan Pérez"
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Correo Electrónico <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            value="{{ old('email', $user->email) }}"
                            required
                            placeholder="juan@example.com"
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Nueva Contraseña
                        </label>
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            placeholder="Dejar en blanco para mantener la contraseña actual"
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                            Solo completa este campo si deseas cambiar la contraseña
                        </p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rol -->
                    <div>
                        <label for="role_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Rol <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="role_id"
                            name="role_id" 
                            required
                            class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">Selecciona un rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->nombre) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Información Adicional -->
                    <div class="bg-zinc-50 dark:bg-zinc-900/50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Información de Registro</h3>
                        <div class="space-y-1 text-sm text-zinc-600 dark:text-zinc-400">
                            <p><span class="font-medium">ID:</span> #{{ $user->id }}</p>
                            <p><span class="font-medium">Registrado:</span> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                            <p><span class="font-medium">Última actualización:</span> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
                            @if($user->sales->isNotEmpty())
                                <p><span class="font-medium">Total de ventas:</span> {{ $user->sales->count() }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <a href="{{ route('users.show', $user) }}" 
                           class="px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                            Actualizar Usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>