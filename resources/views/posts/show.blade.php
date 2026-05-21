<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle del Post
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-3">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $post->title }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Autor: {{ $post->author->name }} | Categoría: {{ $post->category->name }}
                </p>
                <p class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $post->content }}</p>

                <div class="pt-3 border-t dark:border-gray-700">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">Etiquetas</h4>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($post->tags as $tag)
                            <span class="px-2 py-1 rounded bg-indigo-100 text-indigo-700 text-xs">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="pt-3 border-t dark:border-gray-700">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">Archivos adjuntos</h4>
                    <div class="space-y-2 mt-2">
                        @forelse($post->attachments as $file)
                            <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-900 p-2 rounded">
                                <a href="{{ asset('storage/' . $file->path) }}" class="text-indigo-600" target="_blank">
                                    {{ $file->original_name }}
                                </a>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-gray-500">{{ number_format($file->size / 1024, 2) }} KB</span>
                                    @can('delete', $post)
                                        <form method="POST" action="{{ route('attachments.destroy', $file) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 text-sm">Eliminar</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Sin archivos adjuntos.</p>
                        @endforelse
                    </div>
                </div>

                <div class="flex gap-3 pt-3">
                    <a href="{{ route('posts.index') }}" class="px-3 py-2 bg-gray-200 rounded-md text-sm">Volver</a>
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="px-3 py-2 bg-amber-500 text-white rounded-md text-sm">Editar</a>
                    @endcan
                    @can('delete', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-2 bg-red-600 text-white rounded-md text-sm">Eliminar Post</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
