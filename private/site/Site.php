<?php

namespace gmk\site;
/**
 * 
 *
 * @author Artur
 */


require_once (PTH_PRIVATE.DS.'Model.php');
require_once (PTH_PRIVATE.DS.'site/Action.php');
require_once (PTH_PRIVATE.DS.'site/Client.php');
require_once (PTH_PRIVATE.DS.'view/View.php');

class Site {
    
    const SITE_NAME = "Gwint MK";
    
    /**
     * @var array
     */
    private static $errors = array();
    
    
    public static function launchSite()
    {
        // rozpoznaj akcje i zapisz ją jako tekst
        $action = self::recognizeAction();
        
        
        //ładowanie metody klasy Action o nazwie akcji
        $klasa = __NAMESPACE__.'\\'."Action";
        $metoda = $action."Action";
        
        if(method_exists($klasa, $metoda))
        {
            call_user_func(array($klasa,$metoda));
        }
        else
        {
            
           $klasa::error(E_CORE_ERROR, 41, "Nie znaleziono akcji",
                   "próba uruchomienia metody '".$metoda
                   ."' klasy: '".$klasa."' - nie istnieje taka metoda!");
        }
        
        
        
        //\gmk\view\View::render( $action ); 
        
        
       
    }
    
    private static function recognizeAction()
    {
        if(Client::isRegistered())
        {
            if(Client::isPlaying())
            {
                return "resumeGame";
            }
            else
            {
                return "newGame";
            }
        }
        else
        {
            if(self::isSendingNickname())
            {
                return "newClient"; 
            }
            else
            {
                if(self::isRequestingSite())
                {
                    return "visitSite";
                }
                else
                {
                    return "showForm";
                }
            }
        }
        return "error";
    }
    
    private static function doLogic($action)
    {
        //akcja logiczna(obliczenia)
        // tylko dla tych akcji które wymagają logiki
        switch($action)
        {
            case "resumeGame" :
                //TODO: w przypadku niepowodzenia przywrócenia gry, wyczyścić klienta
                Client::resumeGame();
                $show = "resumeGame";
                break;
            
            case "newGame" :
                //TODO: nowa gra
                $show = "newGame";
                break;
            
            case "visitSite" :
                //TODO:
                //odwiedzanie stron
                //404
                //self::visitSite();
                break;
            
            // default - gdy nie rozpoznano - brak wymaganej akcji logicznej, ok
            
            //case "showForm" : - pokaż formularz, brak logiki przed - ok
            //    break;
            
            case "newClient" :
                $r = self::parseNickname();
                Client::newClient();
                break;
            
            
        }
        return $action;
    }
    
    private static function isSendingNickname()
    {
        if(isset($_POST['login']) || isset($_GET['login']) )
        {
           return true; 
        }
        return false;
    }
    
    private static function isRequestingSite()
    {
        if(isset($_GET['page']) )
        {
           return true; 
        }
        return false;
    }
    
    public static function logError($errno, $txt, $level)
    {
        $this->errors[] = array('errno'=> $errno, 'txt'=> $txt, 'level' => $level);
    }
}
