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
            [
                "title" => "A loyal dog helps his master turn sheep's wool",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "old_man_and_sheep.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "dog.mp4",
                "privacy" => "public",
                "categories_id" => 1,
                "channel_id" => 1
            ],
            [
                "title" => "Ashley Anderson and Jacob Mann",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "fire_heart.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Ashley.mp4",
                "privacy" => "public",
                "categories_id" => 2,
                "channel_id" => 1
            ],
            [
                "title" => "A Silent Voice",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "silent_voice.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "ASilentVoice.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "Best Animated Music Video",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "cute_girl_and_tiger.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "BestAnimated.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 2
            ],
            [
                "title" => "Cat",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "white_cat.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Cat.mp4",
                "privacy" => "public",
                "categories_id" => 1,
                "channel_id" => 1
            ],
            [
                "title" => "Counting Sheep",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "sheep.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "CountingSheep.mp4",
                "privacy" => "public",
                "categories_id" => 2,
                "channel_id" => 2
            ],
            [
                "title" => "Demon Slayer Royalty",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "demon_slayer.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "DemonSlayerRoyalty.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 3
            ],
            [
                "title" => "Evangeline",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "hat_child.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Evangeline.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "Felt Love Film",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "purple_hair_child.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "FeltLoveFilm.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "Green Light",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "astro_boy.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "GreenLight.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "HOPE",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "litle_turtle.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "HOPE.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 3
            ],
            [
                "title" => "Lauv Steal The Show",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "water_fire.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "LauvStealTheShow.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "Let's Eat",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "let_eat.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Let'sEat.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "Life & Butterflies",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "boy_and_butterfly.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "LifeButterflies.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 2
            ],
            [
                "title" => "Lightning Boy",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "two_brother.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "LightningBoy.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "lounraw x FLAT",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "man_in_library.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "lounrawxFLAT.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 2
            ],
            [
                "title" => "Miles to Fly",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "black_hair_child.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "MilestoFly.mp4",
                "privacy" => "public",
                "categories_id" => 1,
                "channel_id" => 1
            ],
            [
                "title" => "One Small Step",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "astro_girl.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "OneSmallStep.mp4",
                "privacy" => "public",
                "categories_id" => 2,
                "channel_id" => 1
            ],
            [
                "title" => "Piper",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "litle_bird.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Piper.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "Scarlett",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "red_hair_child.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Scarlett.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 2
            ],
            [
                "title" => "Shim Chung",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "student_girl.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "ShimChung.mp4",
                "privacy" => "public",
                "categories_id" => 1,
                "channel_id" => 1
            ],
            [
                "title" => "Solo Leveling Living Life In The Night",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "solo_leveling.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Solo_Leveling_Living_Life_In_The_Night.mp4",
                "privacy" => "public",
                "categories_id" => 2,
                "channel_id" => 2
            ],
            [
                "title" => "Spring",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "wooden_stick_girl.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Spring.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 3
            ],
            [
                "title" => "Sunshine Best Animation Music Video",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "litle_boy_and_litle_girl.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Sunshine_Best_Animation_Music_Video.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "SUZUME",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "school_girl_anime.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "SUZUME.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "The Present OFFICIAL",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "boy_and_dog.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "The_Present.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "UP Carl & Ellie",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "fly_house.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "UP_Carl_&_Ellie.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 3
            ],
            [
                "title" => "Watermelon A Cautionary Tale",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "watermeland_child.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Watermelon_A_Cautionary_Tale.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "Wings",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "mouse_and_bird.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "Wings.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
            [
                "title" => "The Wishgranter",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum.",
                "thumbnail" => "coin.JPG",
                "date_time" => "2023/7/5 11:36:14",
                "viewer" => 0,
                "path" => "The_Wishgranter.mp4",
                "privacy" => "public",
                "categories_id" => 3,
                "channel_id" => 1
            ],
        ];
        foreach ($videos as $video) {
            ModelsVideo::create($video);
        }
    }
}