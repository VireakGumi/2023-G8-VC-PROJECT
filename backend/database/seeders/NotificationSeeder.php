<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $notificatons = [
            ['user_id' => 2, 'video_id' => 3, 'channel_id' => 2, 'date_time' => '2023/7/5 11:36:14'],
            ['user_id' => 2, 'video_id' => 6, 'channel_id' => 2, 'date_time' => '2023/7/5 11:36:14'],
            ['user_id' => 2, 'video_id' => 18, 'channel_id' => 2, 'date_time' => '2023/7/5 11:36:14'],
            ['user_id' => 3, 'video_id' => 4, 'channel_id' => 3, 'date_time' => '2023/7/5 11:36:14'],
            ['user_id' => 3, 'video_id' => 3, 'channel_id' => 3, 'date_time' => '2023/7/5 11:36:14'],
            ['user_id' => 3, 'video_id' => 7, 'channel_id' => 3, 'date_time' => '2023/7/5 11:36:14'],
        ];
        foreach ($notificatons as $notificaton) {
            Notification::create($notificaton);
        }
    }
}
