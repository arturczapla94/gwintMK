<?php

namespace gmk\model;


require_once (PTH_PRIVATE.DS.'model/helpers/DataManager.php');

/**
 * 
 *
 * @author Artur Czapla
 */
class GeneralDI {
    
    public static $buffer;
    
    public static function connect()
    {
        return DataManager::$generalDC->connect("general");
    }
    
    public static function process()
    {
        return DataManager::$generalDC->process("general", self::$buffer);
    }
    
    public static function close()
    {
        return DataManager::$generalDC->close("general");
    }
    
    
    public static function mget($key)
    {
        DataManager::$generalDC->mget("general",$key);
    }
    
    public static function loadAll()
    {
        DataManager::$generalDC->loadAll("general");
    }
    
    public static function mset($key, $val)
    {
        return DataManager::$generalDC->mset("general", $key, $val);
    }
    
}
