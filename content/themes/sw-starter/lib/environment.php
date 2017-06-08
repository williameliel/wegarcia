<?php
namespace Roots\Sage\Environment;
/**
     * This class helps you to config your application
     * environment.
     * @name Environment
     * @author William Garcia
     * @version 1.0
     */

function getEnvironment() {
    return Environment::env();
}

class Environment {

    public function __construct(){}

    public static function isLocal() {
        return defined('LOCAL') && in_array($_SERVER['SERVER_NAME'], unserialize(LOCAL)) ? true : false;
    }

    public static function isDev() {
        return defined('DEVELOPMENT') && in_array($_SERVER['SERVER_NAME'], unserialize(DEVELOPMENT)) ? true : false;
    }

    public static function isStage() {
        return defined('STAGE') && in_array($_SERVER['SERVER_NAME'], unserialize(STAGE)) ? true : false;
    }

    public static function isProd() {
        return defined('PRODUCTION') && in_array($_SERVER['SERVER_NAME'], unserialize(PRODUCTION)) ? true : false;
    }

    public static function env(){

        if(self::isLocal()){
            return 'local';
        } elseif (self::isDev()){
            return 'dev';
        } elseif (self::isStage()){
            return 'stage';
        } else {
            return 'prod';
        }
    }
}
