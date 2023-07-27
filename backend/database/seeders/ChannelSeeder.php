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
            ['name' => 'The best channel', 'description' => 'best of the world', 'date_time' => '2023/7/5 11:36:14', 'user_id' => 1, 'profile' => '571963-star-wars-4k.jpg'],
            ['name' => 'BoomRange', 'description' => 'best of the world', 'date_time' => '2023/7/5 11:36:14', 'user_id' => 3, 'profile' => '19457.jpg'],
            ['name' => 'Fantacy', 'description' => 'best of the world', 'date_time' => '2023/7/5 11:36:14', 'user_id' => 4, 'profile' => '568018-fantasy-art.jpg']
        ];
        foreach ($channels as $channel) {
            Channel::create($channel);
        }
    }
}
