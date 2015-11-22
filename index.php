<?php


date_default_timezone_set("Europe/Warsaw");
$debug=false;
if(isset($_GET['debug']) && $_GET['debug']==1)
{ //Włącz debugowanie
    $debug=true;
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}
else
{ //debugowanie wyłączone
    ini_set('display_errors',0);
    error_reporting(0);
}
session_start();

define('BASEDIR',__DIR__); 
define('DS',DIRECTORY_SEPARATOR);
define('PTH_PRIVATE',BASEDIR.DS.'private');// public_html/private
define('PTH_PUBLIC',BASEDIR.DS.'public');// public_html/public
define('PTH_DATA',PTH_PRIVATE.DS.'data');


require_once (PTH_PRIVATE.DS.'site/Site.php');
require_once (PTH_PRIVATE.DS.'game/Game.php');




gmk\site\Site::launchSite();

  


  
  
