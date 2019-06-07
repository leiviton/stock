<?php

namespace Stock\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Stock\Console\Commands\OutsCron;
use Stock\Console\Commands\RoadsCron;
use Stock\Console\Commands\StockCron;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        StockCron::class,
        RoadsCron::class,
        OutsCron::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('stocks:cron')->twiceDaily(12, 19);
        $schedule->command('roads:cron')->twiceDaily(11, 19);
        $schedule->command('outs:cron')->twiceDaily(10, 19);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
