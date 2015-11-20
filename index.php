<?php


date_default_timezone_set("Europe/Warsaw");
$debug=true;
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

require_once ('private/Strona.php');
require_once ('private/game/Game.php');




$strona = new Strona();
if(isset($_SESSION['playing']) && $_SESSION['playing'] >= 0)
{
    $r = $strona->resumePlayer();
    if(!$r)
    {
        echo 'błąd 021 - nie udało się przywrócić<br>'.PHP_EOL;
        $strona->clearPlayer();
    }
    
}
else
{
    
    if(!$strona->newPlayer())
    {
        echo 'błąd 022<br>\n';
    }
}
  


  
  
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
      
    </body>
</html>
