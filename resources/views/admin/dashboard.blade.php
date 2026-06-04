<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Administrativo
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Total Posts</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $total_posts }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Total Usuarios</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $total_users }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Total Comentarios</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $total_comments }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-gray-100">Posts recientes</h3>
                    <div class="space-y-2">
                        @forelse($recent_posts as $post)
                            <div class="border-b dark:border-gray-700 pb-2">
                                <p class="font-medium text-gray-800 dark:text-gray-200">{{ $post->title }}</p>
                                <p class="text-xs text-gray-500">{{ $post->author->name }} - {{ $post->created_at->format('d/m/Y') }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500">Sin posts.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-gray-100">Auditoría reciente</h3>
                    <div class="space-y-2">
                        @forelse($recent_audits as $audit)
                            <div class="border-b dark:border-gray-700 pb-2">
                                <p class="font-medium text-gray-800 dark:text-gray-200">{{ $audit->action }} {{ $audit->model_type }}#{{ $audit->model_id }}</p>
                                <p class="text-xs text-gray-500">{{ $audit->user_name }} - {{ $audit->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500">Sin cambios registrados.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
