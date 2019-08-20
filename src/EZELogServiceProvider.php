<?php
const EZELOGTYPE_SYSTEM = 'system';
const EZELOGTYPE_AUDIT = 'audit';

namespace EZELog;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EZELogServiceProvider
 *
 * @author muneer
 */

use Illuminate\Support\ServiceProvider;

class EZELogServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
            ], 'migrations');

        $this->publishes([
                __DIR__ . '/../config/ezelog.php' => config_path('ezelog.php')
            ], 'config');
    }

    //put your code here
    public function register() {

        $config = config('ezelog');
        $this->app->bind('ezeAuditLogService', function() use ($config) {
            return new Services\AuditLogService($config);
        });
    }
}
