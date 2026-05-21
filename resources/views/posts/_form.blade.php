@csrf

<div class="space-y-4">
    <div>
        <x-input-label for="title" value="Título" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="content" value="Contenido" />
        <textarea id="content" name="content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">{{ old('content', $post->content ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="category_id" value="Categoría" />
        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            <option value="">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('category_id', $post->category_id ?? 0) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="tags" value="Etiquetas (1 a 5)" />
        <select id="tags" name="tags[]" multiple class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            @php
                $selectedTags = old('tags', isset($post) ? $post->tags->pluck('id')->all() : []);
            @endphp
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" @selected(in_array($tag->id, $selectedTags))>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('tags')" class="mt-2" />
        <x-input-error :messages="$errors->get('tags.*')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="published_at" value="Fecha de publicación (opcional)" />
        <x-text-input id="published_at" name="published_at" type="datetime-local" class="mt-1 block w-full" :value="old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\\TH:i') : '')" />
        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
    </div>

    @if (!isset($post))
        <div>
            <x-input-label for="attachments" value="Adjuntos (máx 5, 5MB c/u)" />
            <input id="attachments" name="attachments[]" type="file" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" class="mt-1 block w-full text-sm dark:text-gray-300">
            <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
            <x-input-error :messages="$errors->get('attachments.*')" class="mt-2" />
        </div>
    @endif

    <x-primary-button>{{ $buttonText }}</x-primary-button>
</div>
