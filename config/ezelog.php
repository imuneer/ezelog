<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    'db_type'       => env('EZELOG_DBTYPE', 'mongo'),
    'db_connection' => env('EZELOG_DB_CONNECTION', ''),
    'log_duration'  => 90, //days,
    'table_name'    => env('EZELOG_AUDIT_TRAIL_TABLE', 'ezelog_audit_trail'),
);
