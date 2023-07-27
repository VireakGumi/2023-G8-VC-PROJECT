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
            ['title' => 'team8', 'description' => 'Introduction', 'thumbnail' => '2638499.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'Team8.mp4', 'privacy' => 'public', 'categories_id' => 1, 'channel_id' => 1],
            ['title' => 'rothana', 'description' => 'Introduction', 'thumbnail' => '120697-the-flash-dc-comics-superheroes-5k.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'lonely-anime-boy-playing-guitar-under-the-moon-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 2, 'channel_id' => 1],
            ['title' => 'vila', 'description' => 'Introduction', 'thumbnail' => 'marguerite-729510_1280 (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'car', 'description' => 'Introduction', 'thumbnail' => '4.png', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 2],
            ['title' => 'reak', 'description' => 'Introduction', 'thumbnail' => '19457.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'Team8.mp4', 'privacy' => 'public', 'categories_id' => 1, 'channel_id' => 1],
            ['title' => 'eng', 'description' => 'Introduction', 'thumbnail' => '2638498.png', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'lonely-anime-boy-playing-guitar-under-the-moon-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 2, 'channel_id' => 2],
            ['title' => "k'ya", 'description' => 'Introduction', 'thumbnail' => 'R (1).png', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 3],
            ['title' => 'dog', 'description' => 'Introduction', 'thumbnail' => '1688633176.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'Nature', 'description' => 'Introduction', 'thumbnail' => '2638499.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'pexels-jill-burrow-6392282 (1080p).mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'Educational videos', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'Entertainment videos', 'description' => 'Introduction', 'thumbnail' => 'R.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'anbu-itachi-crying-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 3],
            ['title' => 'News ', 'description' => 'Introduction', 'thumbnail' => '120697-the-flash-dc-comics-superheroes-5k.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'Sports football', 'description' => 'Introduction', 'thumbnail' => 'R (1).png', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'Travel', 'description' => 'Introduction', 'thumbnail' => '2638499.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'tears-in-the-rain-ao-no-exorcist-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 2],
            ['title' => 'adventure', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'pexels-jill-burrow-6392282 (1080p).mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'Health condition', 'description' => 'Introduction', 'thumbnail' => 'marguerite-729510_1280 (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'neon-sign-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 2],
            ['title' => 'wellness', 'description' => 'Introduction', 'thumbnail' => '2638499.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'Team8.mp4', 'privacy' => 'public', 'categories_id' => 1, 'channel_id' => 1],
            ['title' => 'fitness', 'description' => 'Introduction', 'thumbnail' => '120697-the-flash-dc-comics-superheroes-5k.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'lonely-anime-boy-playing-guitar-under-the-moon-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 2, 'channel_id' => 1],
            ['title' => 'Technology ', 'description' => 'Introduction', 'thumbnail' => 'marguerite-729510_1280 (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'economics', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 2],
            ['title' => 'vloggers', 'description' => 'Introduction', 'thumbnail' => 'R (1).png', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'Team8.mp4', 'privacy' => 'public', 'categories_id' => 1, 'channel_id' => 1],
            ['title' => 'Social media', 'description' => 'Introduction', 'thumbnail' => 'R.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'lonely-anime-boy-playing-guitar-under-the-moon-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 2, 'channel_id' => 2],
            ['title' => "physical", 'description' => 'Introduction', 'thumbnail' => 'R (1).png', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 3],
            ['title' => 'explore', 'description' => 'Introduction', 'thumbnail' => 'marguerite-729510_1280 (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'innovation', 'description' => 'Introduction', 'thumbnail' => '2638499.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'pexels-jill-burrow-6392282 (1080p).mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'finance', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'TV shows', 'description' => 'Introduction', 'thumbnail' => 'R.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'anbu-itachi-crying-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 3],
            ['title' => 'love', 'description' => 'Introduction', 'thumbnail' => '120697-the-flash-dc-comics-superheroes-5k.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_17_37_46_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'history', 'description' => 'Introduction', 'thumbnail' => 'R (1).png', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'WIN_20230627_18_00_58_Pro.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'tutorials', 'description' => 'Introduction', 'thumbnail' => '2638499.jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'tears-in-the-rain-ao-no-exorcist-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 2],
            ['title' => 'general', 'description' => 'Introduction', 'thumbnail' => 'R (1).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'pexels-jill-burrow-6392282 (1080p).mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],
            ['title' => 'information', 'description' => 'Introduction', 'thumbnail' => 'marguerite-729510_1280 (2).jpg', 'date_time' => '2023/7/5 11:36:14', 'viewer' => 0, 'path' => 'neon-sign-moewalls.com.mp4', 'privacy' => 'public', 'categories_id' => 3, 'channel_id' => 1],

        ];
        foreach ($videos as $video) {
            ModelsVideo::create($video);
        }
    }
}