<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registro de Auditoría
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b dark:border-gray-700">
                            <th class="py-2">Usuario</th>
                            <th class="py-2">Modelo</th>
                            <th class="py-2">ID</th>
                            <th class="py-2">Acción</th>
                            <th class="py-2">IP</th>
                            <th class="py-2">Fecha</th>
                            <th class="py-2">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($audits as $audit)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $audit->user_name }}</td>
                                <td class="py-2">{{ $audit->model_type }}</td>
                                <td class="py-2">{{ $audit->model_id }}</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 text-xs rounded {{ $audit->action === 'create' ? 'bg-green-100 text-green-700' : ($audit->action === 'update' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $audit->action }}
                                    </span>
                                </td>
                                <td class="py-2">{{ $audit->ip_address }}</td>
                                <td class="py-2">{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                                <td class="py-2">
                                    <a href="{{ route('admin.audits.show', $audit) }}" class="text-indigo-600">Ver</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-4 text-center text-gray-500">Sin registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $audits->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
