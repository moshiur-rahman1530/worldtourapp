<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name'=>'Admin',
                'email'=>'mostafizor@gmail.com',
                'is_admin'=>'1',
                'password'=> bcrypt('1234'),
            ],
            [
                'name'=>'Regular User',
                'email'=>'user@gmail.com',
                'is_admin'=>'0',
                'password'=> bcrypt('1234'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
