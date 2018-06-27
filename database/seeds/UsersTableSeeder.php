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

        // Init Administrator
        $userAdmin = User::create([
            'name'  => 'Administrator',
            'username'  =>  'admin',
            'email' =>  'canh.ph@techatrium.com',
            'password' => bcrypt('password')
        ]);

    }
}
