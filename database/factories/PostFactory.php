<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $userId = User::query()->inRandomOrder()->value('id');
        $categoryId = Category::query()->inRandomOrder()->value('id');

        return [
            'user_id' => $userId ?? User::factory(),
            'category_id' => $categoryId ?? Category::factory(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(5, true),
            'views' => $this->faker->numberBetween(0, 1000),
            'published_at' => $this->faker->optional()->dateTimeBetween('-30 days', '+15 days'),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (): array => [
            'published_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (): array => [
            'published_at' => null,
        ]);
    }
}
