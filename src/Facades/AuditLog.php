<?php
namespace EZELog\Facades;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuditLog
 *
 * @author muneer
 */

use Illuminate\Support\Facades\Facade;

class AuditLog extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ezeAuditLogService';
    }
}
