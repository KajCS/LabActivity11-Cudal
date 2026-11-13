<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all();

        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        $kagawad = Author::where('email', 'kagawad.cudal@bulletin.test')->first();

        Post::create([
            'author_id'    => $kagawad->id,
            'title'        => 'Purok Cudal Clean-up Drive',
            'category'     => 'Announcement',
            'body'         => 'Write your own short announcement about the clean-up drive here.',
            'is_published' => true,
            'is_pinned'    => true,
            'published_at' => '2026-03-15 08:00:00'
        ]);
    }
}