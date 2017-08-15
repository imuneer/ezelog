<?php
namespace EZELog\Models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuditTrail
 *
 * @author muneer
 */

use Illuminate\Database\Eloquent\Model;

class AuditTrailSQL extends Model {

    public $timestamps = false;
    protected $table = 'ezelog';
    protected $connection = '';

    protected $fillable = ['user', 'action_time', 'timestamp', 'from_ip', 'server', 'user_agent', 'uri', 'query', 'ezemanage_user', 'action'];

    public function setTable($table) {
        $this->table = $table;
        parent::setTable($table);
    }

    public function setConnection($name) {
        parent::setConnection($name);
    }
}
