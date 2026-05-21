<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin - Detalle Post
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-3">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $post->title }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Autor: {{ $post->author->name }} | Categoría: {{ $post->category->name }}
                </p>
                <p class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $post->content }}</p>
                <a href="{{ route('admin.posts.edit', $post) }}" class="inline-block px-3 py-2 bg-amber-500 text-white rounded-md text-sm">Editar</a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Auditoría del post</h4>
                <div class="space-y-2">
                    @forelse($audits as $audit)
                        <div class="border-b dark:border-gray-700 pb-2">
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $audit->action }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $audit->user_name }} - {{ $audit->created_at->format('d/m/Y H:i:s') }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">Sin registros de auditoría para este post.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
