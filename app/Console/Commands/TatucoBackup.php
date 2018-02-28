<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
class TatucoBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tatuco:backup_bd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realizar Respaldo de la base de datos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Schedule $schedule)
    {
         $host = config('database.connections.pgsql.host');
            $user = config('database.connections.pgsql.username');
            $pass = config('database.connections.pgsql.password');
            $bd = config('database.connections.pgsql.database');
            $port = config('database.connections.pgsql.port');
          $schedule->exec('/usr/bin/pg_dump --host '.$host.' --port '.$port.' --username "'.$user.'" --no-password "'.$bd.'"')
         ->sendOutputTo('/home/maria/laravel-tatuco/backup_tatuco.backup');
       
    }
}
