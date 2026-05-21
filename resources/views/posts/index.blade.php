<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Posts
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="flex justify-between items-center">
                <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Nuevo Post</a>
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600">Ir a panel admin</a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b dark:border-gray-700">
                            <th class="py-2">Título</th>
                            <th class="py-2">Autor</th>
                            <th class="py-2">Categoría</th>
                            <th class="py-2">Adjuntos</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $post->title }}</td>
                                <td class="py-2">{{ $post->author->name }}</td>
                                <td class="py-2">{{ $post->category->name }}</td>
                                <td class="py-2">{{ $post->attachments->count() }}</td>
                                <td class="py-2 flex gap-2">
                                    <a href="{{ route('posts.show', $post) }}" class="text-indigo-600">Ver</a>
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}" class="text-amber-600">Editar</a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">Sin posts.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
