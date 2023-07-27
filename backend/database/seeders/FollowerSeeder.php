<?php

namespace Database\Seeders;

use App\Models\Follower;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $followers = [
            ['channel_id' => 2, 'user_id' => 1, 'date_time' => "2023/7/5 11:36:14"],
            ['channel_id' => 3, 'user_id' => 1, 'date_time' => "2023/7/5 11:36:14"],
        ];
        foreach($followers as $follow) {
            Follower::create($follow);
        }
    }

}