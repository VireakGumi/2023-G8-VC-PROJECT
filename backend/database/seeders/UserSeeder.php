<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users= [
            ['id'=>1, 'full_name'=>'SeangEng', 'email'=>'seangeng1@gmail.com', 'password'=>'123456789!@#$%^&*','role_id'=>1],
            ['id'=>2, 'full_name'=>'KimJame', 'email'=>'KimJame@gmail.com', 'password'=>'123456789!@#$%^&*','role_id'=>1],
            ['id'=>3, 'full_name'=>'MC JK', 'email'=>'mcjk@gmail.com', 'password'=>'123456789!@#$%^&*','role_id'=>1],
            ['id'=>4, 'full_name'=>'Luke Johnsan', 'email'=>'lukejohnsan@gmail.com', 'password'=>'123456789!@#$%^&*','role_id'=>1],
            ['id'=>5, 'full_name'=>'John Jewish', 'email'=>'John@gmail.com', 'password'=>'123456789!@#$%^&*','role_id'=>1],
        ];
        foreach( $users as $user){
            User::create($user);
        }
    }
}
