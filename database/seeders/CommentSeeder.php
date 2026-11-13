<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach (Post::where('is_published', true)->get() as $post) {
            Comment::factory()
                ->count(rand(0, 5))
                ->sequence(fn ($seq) => ['user_id' => $users->random()->id])
                ->create(['post_id' => $post->id]);
        }

        $pinned  = Post::where('is_pinned', true)->first();
        $lola    = User::where('email', 'lola.cudal@bulletin.test')->first();
        $kagawad = User::where('email', 'kagawad.cudal@bulletin.test')->first();

        $pinned->comments()->create([
            'user_id' => $lola->id,
            'body'    => 'Salamat Kagawad! mo apil ko ugma, magdala kog silhig.',
        ]);

        $pinned->comments()->create([
            'user_id' => $kagawad->id,
            'body'    => 'Salamat Lola! Magkita ta sa covered court alas 7 sa buntag.',
        ]);

        $pinned->comments()->create([
            'user_id' => $users->random()->id,
            'body'    => 'Asa ta mag-meet? Pwede ba magdala og mga bata?',
        ]);
    }
}