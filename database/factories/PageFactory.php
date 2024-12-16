<?php

namespace Database\Factories;

use App\Models\Page;
use Awcodes\Typist\Support\Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Page>
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
            ->heading()
            ->paragraphs(3, true)
            ->heading(3)
            ->paragraphs(2);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'full_page' => false,
            'content' => $content->asJson(),
        ];
    }
}
