<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Liebig\Cron\Facades\Cron;
use App\Models\Tatuco\User;
use Illuminate\Support\Facades\Log;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Event::listen('cron.collectJobs', function(){
            /**cada minuto */
            \Cron::add('ejemplo1','* * * * *', function(){
               $user = User::find(29);
               $user->name = 'ejemplo1';
               $user->update();
                 Log::info('modificado por job ejemplo1');
                return $user;       
            });
            /*cada dos minutos*/
            \Cron::add('ejemplo2','*/2 * * * *', function(){
                $user = User::find(29);
               $user->name = 'ejemplo2';
               $user->update();
                Log::info('modificado por job ejemplo 2');
                return $user;
            });
            /*cada hora*/
            \Cron::add('disabled job','0 * * * *', function(){
                
            },false);

            \Cron::add('luis','0 * * * *', function(){
                return 'hola';   
            });

            \Cron::run();

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
