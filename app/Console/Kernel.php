<?php

namespace App\Console;

use App\Jobs\ExcelBackup;
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
        Commands\ExcelBackupCommand::class,
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

//        $schedule->job(new ExcelBackup())->everyMinute();
//        $schedule->call(function () {
//            $excelBackup = new ExcelBackup();
//            $excelBackup->handle();
////            $this->command->info('Seeded the countries!');
//        })->everyMinute();
        $schedule->command('excel:command')->cron('0 */2 * * *');
//        $schedule->command('route:list')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
