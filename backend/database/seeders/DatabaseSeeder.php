<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Resources\VideoResource;
use App\Models\Categories;
use App\Models\Report;
use App\Models\VideoPlayList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ChannelSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(Video::class);
        $this->call(PlaylistSeeder::class);
        $this->call(VideosPlaylistSeeder::class);
        $this->call(HistorySeeder::class);
        $this->call(VideosPlaylistSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(FollowerSeeder::class);
        $this->call(NotificationSeeder::class);
    }
}
