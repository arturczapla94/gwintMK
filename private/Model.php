<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Artur
 */


define('PTH_PRIVATE',BASEDIR.DS.'private');// public_html/private
define('PTH_PUBLIC',BASEDIR.DS.'public');// public_html/public
define('PTH_DATA',PTH_PRIVATE.DS.'data');



class Model {
    
    const FN_SYSDATA = "sys.dat";
    
    private static $isBuffered = false;
    
    
    private static $buffer = array();
    
    public static function read()
    {
        if(file_exists(PTH_DATA.DIRECTORY_SEPARATOR.self::FN_SYSDATA))
        {
            $r = file_get_contents(PTH_DATA.DIRECTORY_SEPARATOR.self::FN_SYSDATA);
            if($r === False)
            {
                return False;
            }
            self::$buffer = unserialize($r);
        }
        else
        {
            $r = file_put_contents(PTH_DATA.DIRECTORY_SEPARATOR.self::FN_SYSDATA,"");
            if(!$r)
            {
                return FALSE;
            }
           
        }
        self::$isBuffered = TRUE;
        return TRUE;
    }
    
    public static function save()
    {
        echo '<br>'.PTH_DATA.DIRECTORY_SEPARATOR.self::FN_SYSDATA.'<br>';
        return file_put_contents(PTH_DATA.DIRECTORY_SEPARATOR.self::FN_SYSDATA, serialize(self::$buffer));
    }
    
    /**
     * Zwraca wartość dla klucza z zmiennych systemowych
     * @param mixed $key klucz
     * @param mixed $dval wartość domyslna
     * @return mixed wartość pod kluczem, gdy brak klucza zwraca $dval lub NULL, w przypadku nie załadowania bufora zwraca FALSE
     */
    public static function getVar($key, $dval = NULL)
    {
        if(self::$isBuffered)
        {
            if ( array_key_exists($key, self::$buffer) )
            {
                return self::$buffer[$key];
            }
            else
            {
                $buffer[$key] = $dval;
                return $dval;
            }
        }
        return False;
    }
    
    public static function setVar($key, $val)
    {
        if(self::$isBuffered )
        {
            self::$buffer[$key] = $val;
            return TRUE;
        }
        return False;
    }
}
