<x-layouts.app title="Detalle del Usuario">
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">{{ $user->name }}</h1>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Información detallada del usuario</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('users.edit', $user) }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Editar
                </a>
                <a href="{{ route('users.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition">
                    Volver
                </a>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- Información del Usuario -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Información Personal</h2>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Nombre Completo</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Correo Electrónico</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Rol</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($user->role->nombre === 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-400
                                @else bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400
                                @endif">
                                {{ ucfirst($user->role->nombre) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">ID de Usuario</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">#{{ $user->id }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Información de Cuenta -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Información de Cuenta</h2>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Fecha de Registro</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">
                            {{ $user->created_at->format('d/m/Y H:i:s') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Última Actualización</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-white">
                            {{ $user->updated_at->format('d/m/Y H:i:s') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Estado de Verificación</dt>
                        <dd class="mt-1">
                            @if($user->email_verified_at)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                    Verificado
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400">
                                    No Verificado
                                </span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Actividad de Ventas -->
        @if($user->sales->isNotEmpty())
            <div class="mt-6 bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Historial de Ventas</h2>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">
                        Total de {{ $user->sales->count() }} venta(s) registrada(s)
                    </p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">ID Venta</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Total (kg)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach($user->sales->take(5) as $sale)
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                                    <td class="px-6 py-4 text-sm text-zinc-900 dark:text-white">#{{ $sale->id }}</td>
                                    <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ \Carbon\Carbon::parse($sale->fecha_venta)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                            {{ number_format($sale->total, 2) }} kg
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('sales.show', $sale) }}" 
                                           class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                            Ver Detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($user->sales->count() > 5)
                    <div class="px-6 py-4 bg-zinc-50 dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-700 text-center">
                        <a href="{{ route('sales.index') }}" 
                           class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                            Ver todas las ventas →
                        </a>
                    </div>
                @endif
            </div>
        @else
            <div class="mt-6 bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-zinc-400 dark:text-zinc-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Sin Actividad de Ventas</h3>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Este usuario aún no ha registrado ninguna venta.</p>
            </div>
        @endif

        <!-- Botón de Eliminación (solo si no es el usuario actual) -->
        @if($user->id !== auth()->id())
            <div class="mt-6 bg-white dark:bg-zinc-800 rounded-xl border border-red-200 dark:border-red-900/50 p-6">
                <h2 class="text-lg font-semibold text-red-900 dark:text-red-400 mb-2">Zona Peligrosa</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Una vez eliminado, este usuario no podrá ser recuperado. Todas sus ventas permanecerán en el sistema.
                </p>
                <form method="POST" action="{{ route('users.destroy', $user) }}" 
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Eliminar Usuario
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-layouts.app>