<?php

namespace gmk\site;
/**
 * 
 *
 * @author Artur
 */


require_once (PTH_PRIVATE.DS.'site/Client.php');
require_once (PTH_PRIVATE.DS.'Model.php');
require_once (PTH_PRIVATE.DS.'view/View.php');

class Site {
    
    const SITE_NAME = "Gwint MK";
    
    /**
     * @var array
     */
    private static $errors = array();
    
    
    public static function launchSite()
    {
        $action = self::recognizeAction();
        
        
        switch($action)
        {
            case "resumeGame" :
                //TODO: w przypadku niepowodzenia przywrócenia gry, wyczyścić klienta
                Client::resumeGame();
                \gmk\view\View::render( array('action'=>$action) ); 
                break;
            
            case "newGame" :
                //TODO: nowa gra
                \gmk\view\View::render( array('action'=>$action) ); 
                break;
            
            case "newClient" :
                
                Client::newClient();
                \gmk\view\View::render( array('action'=>$action) ); 
                break;
            
            case "visitSite" :
                
                self::visitSite();
                \gmk\view\View::render( array('action'=>$action) ); 
                
                break;
            
            case "showForm" :
                
                \gmk\view\View::renderForm( array('errors'=>self::$errors) );
                //\gmk\view\View::render( array('action'=>$action) ); 
                
                break;
            
            default :
                \gmk\view\View::renderError( array('errors'=>self::$errors) ); 
            
        }
        
       
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
    
    private static function isSendingNickname()
    {
        if(isset($_POST['nickname']) || isset($_GET['nickname']) )
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
