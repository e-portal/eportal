<?php

namespace Fresh\Estet\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\getSubscribe::class,
        Commands\SendNews::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call('\Fresh\Estet\Repositories\SitemapRepository@index')->everyMinute();
        $schedule->call('\Fresh\Estet\Repositories\SitemapRepository@index')->dailyAt('13:50');
        $schedule->call('\Fresh\Estet\Http\Controllers\SitemapController@index')->dailyAt('13:46');
        /*$schedule->command('getSubscribe')->everyMinute();
        $schedule->command('sendNews')->everyMinute();*/
        $schedule->command('getSubscribe')->dailyAt('01:50')->withoutOverlapping();
        $schedule->command('sendNews')->dailyAt('01:40')->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
