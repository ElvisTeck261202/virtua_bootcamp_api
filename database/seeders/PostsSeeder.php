<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            \App\Models\Post::create([
            'user_uuid' => $user->uuid,
            'name' => 'Primer post de ' . $user->name,
            'description' => 'Este es el contenido del primer post de ' . $user->name,
            ]);

            \App\Models\Post::create([
            'user_uuid' => $user->uuid,
            'name' => 'Segundo post de ' . $user->name,
            'description' => 'Este es el contenido del segundo post de ' . $user->name,
            ]);
        }
    }
}
