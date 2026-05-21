<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de Auditoría
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-3">
                <p><strong>Usuario:</strong> {{ $audit->user_name }}</p>
                <p><strong>Modelo:</strong> {{ $audit->model_type }}</p>
                <p><strong>ID Modelo:</strong> {{ $audit->model_id }}</p>
                <p><strong>Acción:</strong> {{ $audit->action }}</p>
                <p><strong>IP:</strong> {{ $audit->ip_address }}</p>
                <p><strong>User Agent:</strong> {{ $audit->user_agent }}</p>
                <p><strong>Fecha:</strong> {{ $audit->created_at->format('d/m/Y H:i:s') }}</p>

                <div>
                    <h3 class="font-semibold mt-4">Valores anteriores</h3>
                    <pre class="mt-2 p-3 bg-gray-100 dark:bg-gray-900 rounded text-xs overflow-x-auto">{{ json_encode($audit->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>

                <div>
                    <h3 class="font-semibold mt-4">Valores nuevos</h3>
                    <pre class="mt-2 p-3 bg-gray-100 dark:bg-gray-900 rounded text-xs overflow-x-auto">{{ json_encode($audit->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
