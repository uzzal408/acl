<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            array(
                'model'=>'user',
                'permissions' => 4,
            ),
            array(
                'model'=>'role',
                'permissions' => 4,
            ),
            array(
                'model'=>'category',
                'permissions' => 4,
            )
        );
        $jsonPermissions = json_encode($permissions);
        Role::create([
            'title' => 'Super Admin',
            'permissions' => $jsonPermissions,
        ]);
    }
}
