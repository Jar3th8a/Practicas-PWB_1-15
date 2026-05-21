<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        $editorRole = Role::where('name', 'editor')->firstOrFail();
        $viewerRole = Role::where('name', 'viewer')->firstOrFail();
        $adminRole = Role::where('name', 'admin')->firstOrFail();

        $admin->roles()->attach($adminRole);

        $users = User::factory(10)->create();

        $users->take(5)->each(function (User $user) use ($editorRole): void {
            $user->roles()->attach($editorRole);
        });

        $users->slice(5)->each(function (User $user) use ($viewerRole): void {
            $user->roles()->attach($viewerRole);
        });

        $categories = Category::factory(5)->create();
        $tags = Tag::factory(15)->create();

        Post::factory(50)
            ->make()
            ->each(function (Post $post) use ($users, $categories, $tags): void {
                $post->user_id = $users->random()->id;
                $post->category_id = $categories->random()->id;
                $post->save();

                $post->tags()->attach($tags->random(rand(1, 5))->pluck('id')->all());

                Comment::factory(rand(2, 6))
                    ->make()
                    ->each(function (Comment $comment) use ($post, $users): void {
                        $comment->post_id = $post->id;
                        $comment->user_id = $users->random()->id;
                        $comment->save();
                    });
            });
    }
}
