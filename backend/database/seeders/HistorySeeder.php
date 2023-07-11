<?php

namespace Database\Seeders;

use App\Models\history;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $histories = [
          ['video_id' => 1,'user_id' => 1,'date_time' =>'2023/7/5 11:36:14'],
          ['video_id' => 2,'user_id' => 1,'date_time' =>'2023/7/5 11:36:14'],
          ['video_id' => 3,'user_id' => 1,'date_time' =>'2023/7/5 11:36:14'],
          ['video_id' => 4,'user_id' => 1,'date_time' =>'2023/7/5 11:36:14'],
          ['video_id' => 5,'user_id' => 1,'date_time' =>'2023/7/5 11:36:14']

        ];
        foreach ($histories as $history){
            history::create($history);
        }
    }
}
