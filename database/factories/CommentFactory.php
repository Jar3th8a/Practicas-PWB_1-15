<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        $postId = Post::query()->inRandomOrder()->value('id');
        $userId = User::query()->inRandomOrder()->value('id');

        return [
            'post_id' => $postId ?? Post::factory(),
            'user_id' => $userId ?? User::factory(),
            'content' => $this->faker->paragraph(),
        ];
    }
}
