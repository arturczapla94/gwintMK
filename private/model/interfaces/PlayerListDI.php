<?php

namespace gmk\model;


require_once (PTH_PRIVATE.DS.'model/helpers/DataManager.php');

/**
 * 
 *
 * @author Artur Czapla
 */
class PlayerListDI {
    
    
    
    public static function connect()
    {
        DataManager::$playerListDC->connect("playerlist");
    }
    
    public static function process()
    {
        $r = DataManager::$playerListDC->process("playerlist", self::$buffer);
    }
    
    public static function close()
    {
        DataManager::$generalDC->close("playerlist");
    }
    
    
    public static function mload($playerid)
    {
        DataManager::$generalDC->mload("playerlist",$playerid);
    }
    
   /* public static function loadAll()
    {
        DataManager::$generalDC->loadAll("general");
    }*/
    
    public static function mupdate($playerid, $values)
    {
        DataManager::$generalDC->mupdate("playerlist", $playerid, $values);
    }
    
    public static function getFreeID()
    {
        return DataManager::$playerListDC->getFreePlayerID();
    }
    
    
}
