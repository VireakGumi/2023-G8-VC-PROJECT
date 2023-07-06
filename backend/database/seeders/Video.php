<?php

namespace Database\Seeders;

use App\Models\Video as ModelsVideo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Video extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $videos = [
            ['title' => 'team8', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'Team8.mp4', 'user_id' => 1],
            ['title' => 'team8-1', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'user_id' => 1],
            ['title' => 'team8-2', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'user_id' => 1],
            ['title' => 'team8-2', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4', 'user_id' => 1],
            ['title' => 'team8', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'Team8.mp4', 'user_id' => 1],
            ['title' => 'team8-1', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'user_id' => 1],
            ['title' => 'team8-2', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'user_id' => 1],
            ['title' => 'team8-2', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4', 'user_id' => 1],
            ['title' => 'team8', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'Team8.mp4', 'user_id' => 1],
            ['title' => 'team8-1', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'user_id' => 1],
            ['title' => 'team8-2', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'user_id' => 1],
            ['title' => 'team8-2', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4', 'user_id' => 1],
        ];
        foreach($videos as $video){
            ModelsVideo::create($video);
        }
    }   
}
