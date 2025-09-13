<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSwaggerSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Swagger/OpenAPI documentation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating Swagger docs...');

        // Call the existing l5-swagger:generate command
        $exitCode = $this->call('l5-swagger:generate');

        if ($exitCode === 0) {
            $this->info('Swagger documentation generated successfully!');
        } else {
            $this->error('Error generating Swagger documentation.');
        }

        return $exitCode;
    }
}