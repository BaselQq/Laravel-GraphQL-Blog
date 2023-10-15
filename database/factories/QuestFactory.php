<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Quest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quest>
 */
class QuestFactory extends Factory
{

    protected $model = Quest::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryIDs = Category::all()->pluck('id')->toArray();
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(),
            'reward' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->randomElement($categoryIDs)
        ];
    }
}
