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
            ["title" => "A loyal dog helps his master turn sheep's wool", "description" => "Introduction", "thumbnail" => "old_man_and_sheep.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "A loyal dog helps his master turn sheep's wool.mp4", "privacy" => "public", "categories_id" => 1, "channel_id" => 1],
            ["title" => "Ashley Anderson and Jacob Mann", "description" => "Introduction", "thumbnail" => "fire_heart.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Ashley-Anderson-and-Jacob-Mann.mp4", "privacy" => "public", "categories_id" => 2, "channel_id" => 1],
            ["title" => "A Silent Voice", "description" => "Introduction", "thumbnail" => "silent_voice.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "A-Silent-Voice.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "Best Animated Music Video", "description" => "Introduction", "thumbnail" => "cute_girl_and_tiger.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Best-Animated-Music-Video.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 2],
            ["title" => "Cat", "description" => "Introduction", "thumbnail" => "white_cat.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Cat.mp4", "privacy" => "public", "categories_id" => 1, "channel_id" => 1],
            ["title" => "Counting Sheep", "description" => "Introduction", "thumbnail" => "sheep.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Counting-Sheep.mp4", "privacy" => "public", "categories_id" => 2, "channel_id" => 2],
            ["title" => "Demon Slayer Royalty", "description" => "Introduction", "thumbnail" => "demon_slayer.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Demon-Slayer-Royalty.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 3],
            ["title" => "Evangeline", "description" => "Introduction", "thumbnail" => "hat_child.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Evangeline.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "Felt Love Film", "description" => "Introduction", "thumbnail" => "purple_hair_child.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Felt-Love-Film.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "Green Light", "description" => "Introduction", "thumbnail" => "astro_boy.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Green-Light.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "HOPE", "description" => "Introduction", "thumbnail" => "litle_turtle.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "HOPE.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 3],
            ["title" => "Lauv Steal The Show", "description" => "Introduction", "thumbnail" => "water_fire.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Lauv-Steal-The-Show.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "Let's Eat", "description" => "Introduction", "thumbnail" => "let_eat.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Let's-Eat.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "Life & Butterflies", "description" => "Introduction", "thumbnail" => "boy_and_butterfly.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Life-Butterflies.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 2],
            ["title" => "Lightning Boy", "description" => "Introduction", "thumbnail" => "two_brother.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Lightning-Boy.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "lounraw x FLAT", "description" => "Introduction", "thumbnail" => "man_in_library.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "lounraw-x-FLAT.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 2],
            ["title" => "Miles to Fly", "description" => "Introduction", "thumbnail" => "black_hair_child.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Miles-to-Fly.mp4", "privacy" => "public", "categories_id" => 1, "channel_id" => 1],
            ["title" => "One Small Step", "description" => "Introduction", "thumbnail" => "astro_girl.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "One-Small-Step.mp4", "privacy" => "public", "categories_id" => 2, "channel_id" => 1],
            ["title" => "Piper", "description" => "Introduction", "thumbnail" => "litle_bird.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Piper.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "Scarlett", "description" => "Introduction", "thumbnail" => "red_hair_child.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Scarlett.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 2],
            ["title" => "Shim Chung", "description" => "Introduction", "thumbnail" => "student_girl.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Shim-Chung.mp4", "privacy" => "public", "categories_id" => 1, "channel_id" => 1],
            ["title" => "Solo Leveling Living Life In The Night", "description" => "Introduction", "thumbnail" => "solo_leveling.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Solo-Leveling-Living-Life-In-The-Night.mp4", "privacy" => "public", "categories_id" => 2, "channel_id" => 2],
            ["title" => "Spring", "description" => "Introduction", "thumbnail" => "wooden_stick_girl.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Spring.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 3],
            ["title" => "Sunshine Best Animation Music Video", "description" => "Introduction", "thumbnail" => "litle_boy_and_litle_girl.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Sunshine-Best-Animation-Music-Video.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "SUZUME", "description" => "Introduction", "thumbnail" => "school_girl_anime.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "SUZUME.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "The Present OFFICIAL", "description" => "Introduction", "thumbnail" => "boy_and_dog.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "The-Present-OFFICIAL.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "UP Carl & Ellie", "description" => "Introduction", "thumbnail" => "fly_house.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "UP-Carl-&-Ellie.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 3],
            ["title" => "Watermelon A Cautionary Tale", "description" => "Introduction", "thumbnail" => "watermeland_child.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Watermelon-A-Cautionary-Tale.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "Wings", "description" => "Introduction", "thumbnail" => "mouse_and_bird.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "Wings.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
            ["title" => "The Wishgranter", "description" => "Introduction", "thumbnail" => "coin.JPG", "date_time" => "2023/7/5 11:36:14", "viewer" => 0, "path" => "The-Wishgranter.mp4", "privacy" => "public", "categories_id" => 3, "channel_id" => 1],
        ];
        foreach ($videos as $video) {
            ModelsVideo::create($video);
        }
    }
}