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

define('BASEDIR',__DIR__); //public_html/
define('DS',DIRECTORY_SEPARATOR);// /
define('PTH_PRIVATE',BASEDIR.DS.'private');// public_html/private
define('PTH_PUBLIC',BASEDIR.DS.'public');// public_html/public
define('PTH_DATA',PTH_PRIVATE.DS.'data');

//define('PTH_PUB_RES_DIR',PUB_DIR.DS.'res');// public_html/public/res
//define('PTH_PRIV_RES_DIR',PRIV_DIR.DS.'res');// public_html/private/res
//define('PTH_PRIV_THEMES_DIR',PRIV_DIR.DS.'themes');// public_html/private/themes
//define('APPS_DIR',PRIV_DIR.DS.'apps');// public_html/private
//define('SYS_DIR',PRIV_DIR.DS.'sys');// public_html/private/sys

class Model {
    
    public static function getVar($key )
    {
        
    }
}
