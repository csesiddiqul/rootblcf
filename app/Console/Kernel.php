<?php

namespace App\Console;

use App\Http\Controllers\PublicController;
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
        // \jdavidbakr\LaravelCacheGarbageCollector\LaravelCacheGarbageCollector::class,
        Commands\StatusUpdate::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('cache:gc')
        //          ->everyMinute();
        //$schedule->command('status:update')->everyMinute()->emailOutputTo('mdshihabuddinm@gmail.com');
          /*$schedule->call(function () {
             // (new PublicController())->generatePDF();
          })->everyMinute()->emailOutputTo('mdshihabuddinm@gmail.com');;*/
        $schedule->command('account:report')->daily()->at('00:01');
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
