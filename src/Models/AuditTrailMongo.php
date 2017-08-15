<?php
namespace EZELog\Models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuditTrailMongo
 *
 * @author muneer
 */

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class AuditTrailMongo extends MongoModel{

    protected $collection = "ezelog";
    protected $connection = '';

    public $timestamps = false;

    protected $fillable = ['user', 'action_time', 'timestamp', 'from_ip', 'server', 'user_agent', 'uri', 'query', 'ezemanage_user', 'action'];

    public function setTable($table) {
        $this->collection = $table;
        parent::setTable($table);
    }

    public function setConnection($name) {
        $this->connection = $name;
        parent::setConnection($name);
    }
}
