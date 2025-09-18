<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeatureFlagSeeder extends Seeder
{
    public function run()
    {
        // Clear the table first to avoid unique constraint issues
        DB::table('feature_flags')->truncate();
        
        DB::table('feature_flags')->insert([
            [
                'key' => 'newUI',
                'name' => 'New Page Title',
                'description' => 'New Page Title for CarReports',
                'enabled' => true,
                'rules' => json_encode(['percentage' => 30]), // 30% rollout
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'exportCSV',
                'name' => 'Export CSV button',
                'description' => 'Exports all recordings into CSV',
                'enabled' => true,
                'rules' => null,
                'starts_at' => Carbon::now(),
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'inlineResolve',
                'name' => 'Inline Resolve',
                'description' => 'Inline Resolve',
                'enabled' => true,
                'rules' => json_encode(['whitelist' => [1]]), // user_id 1 can delete
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'deleteReport',
                'name' => 'Delete Report',
                'description' => 'Enables delete feature. It avoids deleting reports from backend and hides delete button if disabled',
                'enabled' => true,
                'rules' => null,
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
