<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeatureFlagSeeder extends Seeder
{
    public function run()
    {
        DB::table('feature_flags')->insert([
            [
                'key' => 'photo_upload_v2',
                'name' => 'Photo Upload V2',
                'description' => 'New photo uploader UI',
                'enabled' => true,
                'rules' => json_encode(['percentage' => 30]), // 30% rollout
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'ai_assessment',
                'name' => 'AI Assessment',
                'description' => 'Run automatic AI checks on reports',
                'enabled' => true,
                'rules' => json_encode(['segments' => [['field' => 'country', 'values' => ['GR','AZ']]]]),
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'allow_delete_reports',
                'name' => 'Allow Delete Reports',
                'description' => 'Whitelist deletion for admins',
                'enabled' => true,
                'rules' => json_encode(['whitelist' => [1]]), // user_id 1 can delete
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}