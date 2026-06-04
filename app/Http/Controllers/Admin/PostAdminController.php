<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Audit;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,editor');
    }

    public function index(): View
    {
        $posts = Post::with(['author', 'category'])
            ->latest()
            ->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $tagIds = $data['tags'] ?? [];
        unset($data['tags']);
        $data['user_id'] = auth()->id();

        $post = Post::create($data);
        $post->tags()->sync($tagIds);

        return redirect()
            ->route('admin.posts.show', $post)
            ->with('success', 'Post creado exitosamente.');
    }

    public function show(Post $post): View
    {
        $post->load(['author', 'category', 'tags', 'attachments']);
        $audits = Audit::where('model_type', 'Post')
            ->where('model_id', $post->id)
            ->latest()
            ->get();

        return view('admin.posts.show', compact('post', 'audits'));
    }

    public function edit(Post $post): View
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $post->load('tags');

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(StorePostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        $tagIds = $data['tags'] ?? [];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tagIds);

        return redirect()
            ->route('admin.posts.show', $post)
            ->with('success', 'Post actualizado.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post eliminado.');
    }
}
