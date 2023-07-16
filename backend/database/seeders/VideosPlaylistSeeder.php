<?php

namespace Database\Seeders;

use App\Models\VideoPlayList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideosPlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $playlsits = [
            ['video_id' => 1, 'play_list_id' => 1],
            ['video_id' => 2, 'play_list_id' => 1],
            ['video_id' => 3, 'play_list_id' => 1],
            ['video_id' => 3, 'play_list_id' => 2],
            ['video_id' => 4, 'play_list_id' => 2],
            ['video_id' => 1, 'play_list_id' => 3],
            ['video_id' => 6, 'play_list_id' => 4],


        ];
        foreach($playlsits as $play) {
            VideoPlayList::create($play);
        }
    }
}
