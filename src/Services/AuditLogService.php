<?php
namespace EZELog\Services;
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

use Auth;

class AuditLogService {

    private $config = [];


    private function getLoggerClass() {

        if (isset($this->config['db_type'])) {
            if ($this->config['db_type'] == \EZELog\Types\DBTypes::SQLDB)
                return \EZELog\Models\AuditTrailSQL::class;
            else
                return \EZELog\Models\AuditTrailMongo::class;
        }
        else
            return \EZELog\Models\AuditTrailSQL::class;
    }

    private function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                if (preg_match("/,/", $_SERVER[$key])) {
                    echo 'matched';
                    foreach (explode(',', $_SERVER[$key]) as $ip){
                        $ip = trim($ip); // just to be safe
                        if (filter_var($ip, FILTER_VALIDATE_IP) !== false){
                            return $ip;
                        }
                    }
                }
                else {
                    if (filter_var($_SERVER[$key], FILTER_VALIDATE_IP) !== false){
                        return $_SERVER[$key];
                    }
                }
            }
        }
    }

    private function getProperties() {
        $properties = array(
            'user' => '',
            'action_time' => new \DateTime(),
            'timestamp' => microtime(true),
            'from_ip' => $this->getIp(),
            'server' => $_SERVER['HTTP_HOST'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'uri' => $_SERVER['REQUEST_URI'],
            'query' => $_SERVER['QUERY_STRING'],
            'ezemanage_user' => false,
        );
        
        $user = Auth::user();
        if (!empty($user)) {
            $properties['user'] = $user->username;
            if (isset($user->ezemanage_user))
                $properties['ezemanage_user'] = (boolean) $user->ezemanage_user;
        }

        return $properties;
    }

    public function __construct(array $config) {
        $this->config = $config;
    }

    public function log($message)  {

        $properties = $this->getProperties();
        $properties['action'] = $message;

        $class = $this->getLoggerClass();
        $classObj = new $class($properties);
        $classObj->setTable($this->config['table_name']);
        if (!empty($this->config['db_connection']))
            $classObj->setConnection($this->config['db_connection']);

        $classObj->save();


        return $properties;
    }
}
