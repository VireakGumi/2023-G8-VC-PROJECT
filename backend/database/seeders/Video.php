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
            ['title' => 'team8', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => '\Team8.mp4','privacy' =>'public','category'=>1, 'user_id' => 1],
            ['title' => 'team8-1', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => '\Team8.mp4', 'privacy' =>'public','category'=>1,'user_id' => 1],
            ['title' => 'team8-2', 'description' => 'Introduction', 'thumbnail' => 'url', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  20, 'path' => '\Team8.mp4', 'privacy' =>'public','category'=>1,'user_id' => 1],
        ];
        foreach($videos as $video){
            ModelsVideo::create($video);
        }
    }   
}
