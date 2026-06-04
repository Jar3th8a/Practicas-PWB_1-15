<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StorePostWithAttachmentsRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['author', 'category', 'tags', 'attachments'])
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostWithAttachmentsRequest $request, FileService $fileService): RedirectResponse
    {
        $data = $request->validated();
        unset($data['attachments'], $data['tags']);
        $data['user_id'] = auth()->id();

        $post = Post::create($data);
        $post->tags()->attach($request->input('tags', []));

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $fileService->storeAttachment($file, $post->id);
            }
        }

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post creado exitosamente.');
    }

    public function show(Post $post): View
    {
        $post->load(['author', 'category', 'tags', 'attachments']);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', $post);

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $post->load('tags');

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(StorePostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $data = $request->validated();
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($request->input('tags', []));

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post actualizado.');
    }

    public function destroy(Post $post, FileService $fileService): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->load('attachments');
        foreach ($post->attachments as $attachment) {
            $fileService->deleteAttachment($attachment);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post eliminado.');
    }
}
