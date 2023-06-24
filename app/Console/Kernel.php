<?php

namespace App\Console;

use App\Console\Commands\CreateAdmin;
use App\Console\Commands\DeleteExpiredUploads;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\CreateAdmin::class,
        DeleteExpiredUploads::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('uploads:delete-expired')->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
