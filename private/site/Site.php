<?php

namespace gmk\site;
/**
 * 
 *
 * @author Artur
 */

require_once (PTH_'/Model.php');

class Site {
    
    
    
    /**
     * @var array
     */
    private static $errors = array();
    
    
    public static function launchSite()
    {
        if(Client::isRegistered())
        {
            $r = Client::resumeClient();
            if(!$r)
            {
                echo 'błąd 021 - nie udało się przywrócić<br>'.PHP_EOL;
                $strona->clearClient();
            }

        }
        else
        {

            if(!Client::newClient())
            {
                echo 'błąd 022<br>\n';
            }
        }
        
    }
    
    public static function logError($errno, $txt, $level)
    {
        $this->errors[] = array('errno'=> $errno, 'txt'=> $txt, 'level' => $level);
    }
}
