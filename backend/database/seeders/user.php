<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            ['full_name' => 'John', 'email' => 'jonh@example.com', 'password' => 'secret', 'role_id' => 1],
        ];
        foreach($users as $user){
            ModelsUser::create($user);
        }
    }
}
