<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// Import your custom command
use App\Console\Commands\GenerateSwaggerSchema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array<int, class-string>
     */
    protected $commands = [
        // Register your custom Swagger generation command
        GenerateSwaggerSchema::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Example: generate Swagger docs daily at 2am
        // $schedule->command('schema:generate')->dailyAt('02:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        // Loads commands in the Console/Commands directory automatically
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}