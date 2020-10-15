<?php

namespace App\Console;

    use Illuminate\Console\Scheduling\Schedule;
    use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

    class Kernel extends ConsoleKernel
    {
        protected $commands = [
            Commands\BitcoinCheck::class,
        ];

        protected function schedule(Schedule $schedule)
        {
            $schedule->command('bitcoin:check')->everyMinute();
            $schedule->command('tickets-closed:delete')->weekly();
        }

        protected function commands()
        {
            $this->load(__DIR__.'/Commands');

            require base_path('routes/console.php');
        }
    }
