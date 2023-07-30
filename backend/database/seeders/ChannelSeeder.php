<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $channels = [
            ['name' => 'The best channel', 'description' => 'best of the world', 'date_time' => '2023/7/5 11:36:14', 'user_id' => 1, 'profile' => 'litle_boy_and_litle_girl.JPG'],
            ['name' => 'BoomRange', 'description' => 'best of the world', 'date_time' => '2023/7/5 11:36:14', 'user_id' => 3, 'profile' => 'boy_and_dog.JPG'],
            ['name' => 'Fantacy', 'description' => 'best of the world', 'date_time' => '2023/7/5 11:36:14', 'user_id' => 4, 'profile' => 'cute_girl_and_tiger.JPG'],
            ['name' => 'kaka', 'description' => 'best of the world', 'date_time' => '2023/7/5 11:36:14', 'user_id' => 5, 'profile' => 'purple_hair_child.JPG']
        ];
        foreach ($channels as $channel) {
            Channel::create($channel);                  
        }
    }
}
