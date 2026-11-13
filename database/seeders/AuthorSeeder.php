<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::create([
            'name'     => 'Kagawad Ken Cudal',
            'position' => 'Kagawad',
            'email'    => 'kagawad.cudal@bulletin.test',
        ]);

        Author::factory()->count(4)->create();
    }
}