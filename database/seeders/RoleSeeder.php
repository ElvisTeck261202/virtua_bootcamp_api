<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = database_path('data/roles.json');
        $json = file_get_contents($file);
        $roles = json_decode($json);

       $existing_roles = Role::all(); 

       foreach($roles as $key => $item) {
        $role = Role::where('id', $item->id)->first();

        if (!empty($role)){
            $role->name = $item->name;
            $role->save();
        } else {
            $newRole = new Role;
            $newRole->id = $item->id;
            $newRole->name = $item->name;
            $newRole->save();
        }
       }

       foreach($existing_roles as $existingRole) {
        $foundInJson = collect($rolles)->firstWhere('id', $existingRole->id);

        if(!$foundInJson) {
            $existingRole->delete();
        }
       }
    }
}
