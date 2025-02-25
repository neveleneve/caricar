<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'budi@gmail.com',
                'password' => bcrypt('password')

            ]
        ];

        $roles = Role::get();
        foreach ($users as $key => $user) {
            $create = User::create($user);
            $create->assignRole($roles[$key]->name);
        }
    }
}
