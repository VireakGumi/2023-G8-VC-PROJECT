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
            ['title' => 'team8', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Team8.mp4','privacy' => 'public','categories_id' => 1, 'user_id' => 1],
            ['title' => 'rothana', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4','privacy' => 'public','categories_id' => 2, 'user_id' => 1],
            ['title' => 'vila', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 1],
            ['title' => 'car', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 2],
            ['title' => 'reak', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Team8.mp4','privacy' => 'public','categories_id' => 1, 'user_id' => 1],
            ['title' => 'eng', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4','privacy' => 'public','categories_id' => 2, 'user_id' => 2],
            ['title' => "k'ya", 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 3],
            ['title' => 'dog', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],

        ];
        foreach($videos as $video){
            ModelsVideo::create($video);
        }
    }   
}
