<?php

require_once (PTH_PRIVATE.DS.'model/helpers/DataManager.php');

namespace gmk\model;

/**
 * 
 *
 * @author Artur Czapla
 */
class GeneralF {
    
    public static function connect()
    {
        
        DataManager::$generalDM->connect("general");
    }
    
    public static function process()
    {
        $r = DataManager::$generalDM->process("general");
        if(isset($r['data']))
        {
            self::$buffer = $r['data'];
        }
    }
    
    public static function close()
    {
        DataManager::$generalDM->close("general");
    }
    
    
    public static $buffer=[];
    
    public static function mget($key)
    {
        DataManager::$generalDM->mget("general",$key);
    }
    
    public static function mset($key, $val)
    {
        DataManager::$generalDM->mset("general", $key, $val);
    }
    
}
