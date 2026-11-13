<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Lola Cudal',
            'email'    => 'lola.cudal@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawadUser = User::create([
            'name'     => 'Kagawad Ken Cudal',
            'email'    => 'kagawad.cudal@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawadAuthor = Author::where('email', 'kagawad.cudal@bulletin.test')->first();
        $kagawadAuthor->user_id = $kagawadUser->id;
        $kagawadAuthor->save();

        User::factory()->count(8)->create();
    }
}