<?php

namespace Stock\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Stock\Console\Commands\AprovCron;
use Stock\Console\Commands\EmailCron;
use Stock\Console\Commands\PedidoCron;
use Stock\Console\Commands\ProtocolsCron;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ProtocolsCron::class,
        EmailCron::class,
        PedidoCron::class,
        AprovCron::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('protocols:cron')->timezone('America/Sao_Paulo')
            ->dailyAt('14:30');

        $schedule->command('emails:cron')->timezone('America/Sao_Paulo')->everyFiveMinutes();
        $schedule->command('pedido:cron')->timezone('America/Sao_Paulo')->everyFiveMinutes();
        $schedule->command('aprov:cron')->timezone('America/Sao_Paulo')->everyFiveMinutes();
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
