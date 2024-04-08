<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(123)
            ],
            [
                'name' => 'Employee',
                'email' => 'employee@gmail.com',
                'password' => bcrypt(123)
            ],
        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}