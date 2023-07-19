<?php

namespace Database\Seeders;

use App\Models\PlayList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $playlsits = [
            ['title' => 'funny', 'user_id' => 1],
            ['title' => 'cartoon', 'user_id' => 1],
            ['title' => 'anime', 'user_id' => 1],
            ['title' => 'funny', 'user_id' => 2],
            ['title' => 'cartoon', 'user_id' => 2],
        ];
        foreach($playlsits as $play) {
            PlayList::create($play);
        }
    }
}
