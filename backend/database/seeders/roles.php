<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            ['role_title' => 'user'],
            ['role_title' => 'content-creator'],
            ['role_title' => 'admin'],
        ];
        foreach($roles as $role){
            Role::create($role);
        }
    }
}
