<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Awcodes\Typist\Support\Faker;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Page::factory()->create([
            'title' => 'Welcome',
            'slug' => 'welcome',
            'content' => Faker::make()
                ->heading(level: 1)
                ->lead()
                ->block(
                    identifier: 'Alert',
                        values: [
                        'color' => 'info',
                        'dismissible' => false,
                        'message' => Factory::create()->sentence(),
                    ])
                ->paragraphs(1)
                ->codeBlock(language: 'javascript')
                ->paragraphs(3, true)
                ->blockquote()
                ->paragraphs(2, true)
                ->unorderedList(3)
                ->paragraphs(2, true)
                ->orderedList(3)
                ->hr()
                ->grid()
                ->small()
                ->asJson(),
        ]);

        Page::factory()->create([
            'title' => 'Null Content',
            'slug' => 'null-content',
            'content' => null,
        ]);

        Page::factory(10)->create();
    }
}
