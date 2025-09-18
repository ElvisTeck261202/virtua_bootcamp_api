<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = database_path('data/permissions.json');
        $json = file_get_contents($file);
        $permissions = json_decode($json);

       $existing_permissions = permission::all(); 

       foreach($permissions as $key => $item) {
        $permission = permission::where('id', $item->id)->first();

        if (!empty($permission)){
            $permission->name = $item->name;
            $permission->save();
        } else {
            $newPermission = new Permission;
            $newPermission->id = $item->id;
            $newPermission->name = $item->name;
            $newPermission->save();
        }
       }

       foreach($existing_permissions as $existingpermission) {
        $foundInJson = collect($rolles)->firstWhere('id', $existingpermission->id);

        if(!$foundInJson) {
            $existingpermission->delete();
        }
       }
    }
}
