<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $role_author = Role::where('name', 'Author')->first();
        $role_admin = Role::where('name', 'Admin')->first();

        $user = new User();
        $user->name = 'Adam';
        $user->email = 'adam@gmail.com';
        $user->password = bcrypt('adam');
        $user->save();

        $user->roles()->attach($role_user);

        $author = new User();
        $author->name = 'Joseph';
        $author->email = 'joseph@gmail.com';
        $author->password = bcrypt('adam');
        $author->save();

        $author->roles()->attach($role_author);

        $admin = new User();
        $admin->name = 'Albert';
        $admin->email = 'albert@gmail.com';
        $admin->password = bcrypt('adam');
        $admin->save();

        $admin->roles()->attach($role_admin);
    }
}
