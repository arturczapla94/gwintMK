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
    const NICKNAME_MINLEN = 4;
    const NICKNAME_MAXLEN = 20;
    /**
     * @var array
     */
    private static $errors = array();
    
    
    public static function parseRNickname()
    {
        $errors = array();
        $nickname = isset($_GET['login']) ? $_GET['login'] : isset($_POST['login']) ? $_POST['login'] : "";
        
        if(iconv_strlen($nickname,'UTF-8') < self::NICKNAME_MINLEN)
        {
            $errors[] = array(1, "nickname_too_short", 
                    "Podana nazwa jest za krótka."
                    ." Musisz podać conajmniej ".self::NICKNAME_MINLEN . " znaków");
        }
        
        if(iconv_strlen($nickname,'UTF-8') > self::NICKNAME_MAXLEN)
        {
            $errors[] = array(2, "nickname_too_long", 
                    "Podana nazwa jest za długa."
                    ." Musisz podać maksymalnie ".self::NICKNAME_MAXLEN . " znaków");
        }
        if(!preg_match('/^[a-zA-Z](?:[a-zA-Z0-9 _-]*[a-zA-Z0-9]){0,1}+$/D', $nickname))
        {
            $errors[] = array(3, "nickname_wrong_characters", 
                    "Podana nazwa zawiera nieprawidłowe znaki!"
                    ." Login musi zaczynać się od litery, może zawierać:"
                    ." spacje litery liczby podkreślnik i pauzę"
                    ." ale musi kończyć się na liczbie lub literze.");
        }
        return array('nickname'=>$nickname, 'errors'=>$errors);
        
    }
    
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
        
    }
    
    private static function recognizeAction()
    {
        if(self::isRequestingSite())
        {
            return "visitSite";
        }
        else
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
                    return "showForm";
                }
            }
        }
        
        return "error";
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
