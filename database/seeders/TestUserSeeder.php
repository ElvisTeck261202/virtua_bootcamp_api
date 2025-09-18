<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(['name' => 'Juan', 'email' => 'j.salcido0810@gmail.com', 'password' => Hash::make('1234567890')]);
        
        $creator1 = User::create([
            'name' => 'creador de contenido',
            'email' => 'creadorcontenido@gmail.com',
            'password' => Hash::make('1234567890')
        ]);

        $creator1->assignRole('creador');
        $allPermissions = Permission::pluck('name')->toArray();
        $creator1->givePermissionTo($allPermissions);
        $creator1->revokePermissionTo(
            'agregar comentarios',
            'editar comentarios',
            'eliminar comentarios'
        );

        $creator2 = User::create([
            'name' => 'creador de contenido 2',
            'email' => 'creadorcontenido2@gmail.com',
            'password' => Hash::make('1234567890')
        ]);

        $creator2->assignRole('creador');
        $allPermissions = Permission::pluck('name')->toArray();
        $creator2->givePermissionTo($allPermissions);
        $creator2->revokePermissionTo(
            'agregar comentarios',
            'editar comentarios',
            'eliminar comentarios'
        );

        $user1 = User::create([
            'name' => 'usuario',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1234567890')
        ]);

        $user1->assignRole('usuario');
        $allPermissions = Permission::pluck('name')->toArray();
        $user1->givePermissionTo($allPermissions);
        $user1->revokePermissionTo(
            'agregar posts',
            'editar posts'

        );

        $user2 = User::create([
            'name' => 'usuario',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1234567890')
        ]);

        $user2->assignRole('usuario');
        $allPermissions = Permission::pluck('name')->toArray();
        $user2->givePermissionTo($allPermissions);
        $user2->revokePermissionTo(
            'agregar posts',
            'editar posts'
        );
    }
}
