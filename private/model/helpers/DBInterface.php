<?php


namespace gmk\model;

/**
 *
 * @author Artur Czapla
 */
abstract class DBInterface {
    public abstract function connect($table);
    public abstract function process($table, &$buffor);
    public abstract function close($table);
    public abstract function loadAll($table);
    
    // GENERAL
    public $generalBuffer;
    public abstract function mset($table, $key, $value);
    public abstract function mget($table, $key);
    
    // PLAYER LST
    
    
    // GAME LST
    
}
