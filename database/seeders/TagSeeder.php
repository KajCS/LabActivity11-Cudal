<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Purok Cudal', 'Urgent', 'Libre', 'Schedule', 'Volunteer'];

        foreach ($names as $name) {
            Tag::create(['name' => $name]);
        }

        $tags = Tag::all();

        foreach (Post::all() as $post) {
            $randomTags = $tags->random(rand(1, 3));
            $post->tags()->attach($randomTags->pluck('id'));
        }

        $pinned = Post::where('is_pinned', true)->first();
        $pinnedTags = Tag::whereIn('name', ['Purok Cudal', 'Urgent'])->pluck('id');
        $pinned->tags()->sync($pinnedTags);
    }
}