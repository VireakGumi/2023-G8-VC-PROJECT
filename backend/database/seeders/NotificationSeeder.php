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
            ['video_id' => 1, 'user_id' => 1, 'date_time' => '2023/7/5 11:36:14'],
            ['video_id' => 2, 'user_id' => 1, 'date_time' => '2023/7/5 11:36:14'],
            ['video_id' => 3, 'user_id' => 1, 'date_time' => '2023/7/5 11:36:14'],
            ['video_id' => 4, 'user_id' => 1, 'date_time' => '2023/7/5 11:36:14'],
            ['video_id' => 5, 'user_id' => 1, 'date_time' => '2023/7/5 11:36:14']
        ];
        foreach ($notificatons as $notificaton) {
            Notification::create($notificaton);
        }
    }
}
