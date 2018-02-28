<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\TatucoBackup'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $date = Carbon::now();
                 $schedule->command('tatuco:backup_bd');
        //          ->hourly();
            $host = config('database.connections.pgsql.host');
            $user = config('database.connections.pgsql.username');
            $pass = config('database.connections.pgsql.password');
            $bd = config('database.connections.pgsql.database');
            $port = config('database.connections.pgsql.port');
          $schedule->exec('/usr/bin/pg_dump --host '.$host.' --port '.$port.' --username "'.$user.'" --no-password "'.$bd.'"')
         ->sendOutputTo('/home/zippyttech/Documentos/backup_tatuco-'.$date.'.backup');

      
        /* $schedule->execute('/usr/bin/pg_dump --host {$host} --port {$port} --username "{$user}" --no-password  --format custom --blobs --verbose --file "/home/maria/laravel-tatuco/laravel" "laravel-tatuco"')*/
        // ->daily()
         //->sendOutputTo('directorio');
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
