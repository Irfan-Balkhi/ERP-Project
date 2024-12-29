<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // Register your Artisan commands here.
    protected $commands = [
        // Add your custom commands here, for example:
        // \App\Console\Commands\YourCustomCommand::class,
    ];

    // Schedule your commands here.
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('finance:update')->daily();  // This runs the 'finance:update' command daily
        $schedule->command('app:update-finance-command')->daily();

    }


    // This method loads the console commands
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
