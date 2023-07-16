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
            ['title' => 'team8', 'description' => 'Introduction', 'thumbnail' => '500aced4d9825ef16c46146032f2395e.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Team8.mp4','privacy' => 'public','categories_id' => 1, 'user_id' => 1],
            ['title' => 'rothana', 'description' => 'Introduction', 'thumbnail' => '216145.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4','privacy' => 'public','categories_id' => 2, 'user_id' => 1],
            ['title' => 'vila', 'description' => 'Introduction', 'thumbnail' => 'OIP.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 1],
            ['title' => 'car', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 2],
            ['title' => 'reak', 'description' => 'Introduction', 'thumbnail' => 'R (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Team8.mp4','privacy' => 'public','categories_id' => 1, 'user_id' => 1],
            ['title' => 'eng', 'description' => 'Introduction', 'thumbnail' => 'R.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4','privacy' => 'public','categories_id' => 2, 'user_id' => 2],
            ['title' => "k'ya", 'description' => 'Introduction', 'thumbnail' => 'R (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 3],
            ['title' => 'dog', 'description' => 'Introduction', 'thumbnail' => 'OIP.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'Nature', 'description' => 'Introduction', 'thumbnail' => '500aced4d9825ef16c46146032f2395e.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'UE5-遗迹.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'Educational videos', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'Entertainment videos', 'description' => 'Introduction', 'thumbnail' => 'R.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Unreal Engine 5 .1 - Summer Wetland Environment with Different Lighting by Lumen.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 3],
            ['title' => 'News ', 'description' => 'Introduction', 'thumbnail' => '216145.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'Sports football', 'description' => 'Introduction', 'thumbnail' => 'R (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'Travel', 'description' => 'Introduction', 'thumbnail' => '500aced4d9825ef16c46146032f2395e.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'yt1s.com - Nature Beautiful short video 720p HD.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 5],
            ['title' => 'adventure', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'UE5-遗迹.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'Health condition', 'description' => 'Introduction', 'thumbnail' => 'OIP.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'yt1s.com - Unity  Mountain Lake  Asset Pack  HDRPURPBuiltin  Cinematic 4K.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 5],
            ['title' => 'wellness', 'description' => 'Introduction', 'thumbnail' => '500aced4d9825ef16c46146032f2395e.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Team8.mp4','privacy' => 'public','categories_id' => 1, 'user_id' => 1],
            ['title' => 'fitness', 'description' => 'Introduction', 'thumbnail' => '216145.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4','privacy' => 'public','categories_id' => 2, 'user_id' => 1],
            ['title' => 'Technology ', 'description' => 'Introduction', 'thumbnail' => 'OIP.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 1],
            ['title' => 'economics', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 2],
            ['title' => 'vloggers', 'description' => 'Introduction', 'thumbnail' => 'R (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Team8.mp4','privacy' => 'public','categories_id' => 1, 'user_id' => 1],
            ['title' => 'Social media', 'description' => 'Introduction', 'thumbnail' => 'R.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'bookList - Personal - Microsoft​ Edge 2023-03-16 08-03-22.mp4','privacy' => 'public','categories_id' => 2, 'user_id' => 2],
            ['title' => "physical", 'description' => 'Introduction', 'thumbnail' => 'R (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 3],
            ['title' => 'explore', 'description' => 'Introduction', 'thumbnail' => 'OIP.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'innovation', 'description' => 'Introduction', 'thumbnail' => '500aced4d9825ef16c46146032f2395e.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'UE5-遗迹.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'finance', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'TV shows', 'description' => 'Introduction', 'thumbnail' => 'R.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'Unreal Engine 5 .1 - Summer Wetland Environment with Different Lighting by Lumen.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 3],
            ['title' => 'love', 'description' => 'Introduction', 'thumbnail' => '216145.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'history', 'description' => 'Introduction', 'thumbnail' => 'R (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'tutorials', 'description' => 'Introduction', 'thumbnail' => '500aced4d9825ef16c46146032f2395e.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'yt1s.com - Nature Beautiful short video 720p HD.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 5],
            ['title' => 'general', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'UE5-遗迹.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 4],
            ['title' => 'information', 'description' => 'Introduction', 'thumbnail' => 'OIP.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' =>  0, 'path' => 'yt1s.com - Unity  Mountain Lake  Asset Pack  HDRPURPBuiltin  Cinematic 4K.mp4','privacy' => 'public','categories_id' => 3, 'user_id' => 1],

        ];
        foreach($videos as $video){
            ModelsVideo::create($video);
        }
    }   
}
