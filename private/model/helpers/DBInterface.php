<?php


namespace gmk\model;

/**
 *
 * @author Artur Czapla
 */
abstract class DBInterface {
    public function connect($table);
    public function process();
    public function close();
    
    public function mset($key, $value);
    public function mget($key);
    
    public $generalBuffered;
}
