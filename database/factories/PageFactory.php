<?php

namespace Database\Factories;

use Awcodes\Typist\Support\Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->words(mt_rand(1, 3), true);
        $content = Faker::make()
            ->block(values: [
                'color' => $this->faker->randomElement([
                    'info',
                    'success',
                    'warning',
                    'danger',
                ]),
                'dismissible' => $this->faker->boolean(20),
                'message' => $this->faker->sentence(),
            ])
            ->heading()
            ->paragraphs(3, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $content->asJson(),
        ];
    }
}
