<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
		Gate::policy(Post::class, PostPolicy::class);

		Gate::define('view-dashboard', function ($user) {
			return $user->hasRole('admin') || $user->hasRole('editor');
		});

		Gate::define('edit-post', function ($user) {
			return $user->hasRole('admin') || $user->hasRole('editor');
		});

		Gate::define('delete-post', function ($user) {
			return $user->hasRole('admin');
		});
	}
}
