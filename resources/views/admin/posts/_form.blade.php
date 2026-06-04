@csrf

<div class="space-y-4">
    <div>
        <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Título</label>
        <input id="title" name="title" type="text" value="{{ old('title', $post->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
        @error('title')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Contenido</label>
        <textarea id="content" name="content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">{{ old('content', $post->content ?? '') }}</textarea>
        @error('content')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Categoría</label>
        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            <option value="">Selecciona categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('category_id', $post->category_id ?? 0) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="tags" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Etiquetas</label>
        @php
            $selectedTags = old('tags', isset($post) ? $post->tags->pluck('id')->all() : []);
        @endphp
        <select id="tags" name="tags[]" multiple class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" @selected(in_array($tag->id, $selectedTags))>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="published_at" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Publicación</label>
        <input id="published_at" name="published_at" type="datetime-local" value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\\TH:i') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
    </div>

    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">{{ $buttonText }}</button>
</div>
