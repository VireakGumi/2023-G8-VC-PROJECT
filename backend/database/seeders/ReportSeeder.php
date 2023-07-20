<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $reports = [
            ['id' => 1, 'user_id' => 1, 'video_id' => 36, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
            ['id' => 2, 'user_id' => 2, 'video_id' => 37, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
            ['id' => 3, 'user_id' => 3, 'video_id' => 38, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
            ['id' => 4, 'user_id' => 4, 'video_id' => 39, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
            ['id' => 5, 'user_id' => 5, 'video_id' => 40, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
            ['id' => 6, 'user_id' => 4, 'video_id' => 43, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
            ['id' => 7, 'user_id' => 2, 'video_id' => 45, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
            ['id' => 8, 'user_id' => 1, 'video_id' => 62, 'comment' => 'yyyy', 'type_of_report' => 'jhhyyy','content_video'=>"ssvv"],
        ];
        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
