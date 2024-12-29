<?php

// If you want to automate the process and ensure that the finance data reflects the latest values daily, even if no admin explicitly triggers the update.
// To prevent stale data from being displayed on the Finance Dashboard if updates aren’t manually triggered.

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\FinanceController;


class UpdateFinanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-finance-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(FinanceController::class)->updateFinanceData();
    }
}
