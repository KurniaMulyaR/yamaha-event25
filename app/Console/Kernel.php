<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// WAJIB IMPORT
use App\Models\PesananNotifikasi;
use App\Jobs\SendScheduledNotificationJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('email:send')->everyMinute();
        // $schedule->call(function () {

        //     PesananNotifikasi::where('status', 'pending')
        //         ->limit(30)
        //         ->get()
        //         ->each(function ($notif) {
        //             SendScheduledNotificationJob::dispatch($notif);
        //         });

        // })->everyMinute(); // jam kirim
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
