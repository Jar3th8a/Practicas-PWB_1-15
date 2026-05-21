<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'total_posts' => Post::count(),
            'total_users' => User::count(),
            'total_comments' => Comment::count(),
            'recent_posts' => Post::with('author')->latest()->take(5)->get(),
            'recent_audits' => Audit::latest()->take(10)->get(),
        ]);
    }
}
