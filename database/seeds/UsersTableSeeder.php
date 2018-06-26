<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // All permission
        $permissions = [
            [
                'name' => 'view',
                'display_name' => 'view',
                'description' => 'view'
            ],
            [
                'name' => 'create',
                'display_name' => 'create',
                'description' => 'create'
            ],
            [
                'name' => 'edit',
                'display_name' => 'edit',
                'description' => 'edit'
            ],
            [
                'name' => 'delete',
                'display_name' => 'delete',
                'description' => 'delete'
            ],
            [
                'name' => 'create_sms',
                'display_name' => 'delete',
                'description' => 'delete'
            ],
            [
                'name' => 'view_sms_list',
                'display_name' => 'delete',
                'description' => 'delete'
            ],
        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }

        // All roles
        $adminRole = Role::create(
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'All permissions'
            ]);

        $roleUser = Role::create(
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Limit permissions'
            ]);

//        $adminRole = Role::where('name', '=', 'admin')->first();
        $adminRole->attachPermissions(Permission::all());

//        $roleUser = Role::where('name', '=', 'user')->first();
        $roleUser->attachPermissions(Permission::where('name', '=', 'view')->get());

        // Init Administrator
        $userAdmin = User::create([
            'name'  => 'Administrator',
            'username'  =>  'admin',
            'email' =>  'canh.ph@techatrium.com',
            'password' => bcrypt('password')
        ]);
        $userAdmin->attachRole($adminRole);

    }
}
