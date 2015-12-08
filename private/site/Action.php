<?php


namespace gmk\site;

require_once (PTH_PRIVATE.DS.'site/Client.php');
/**
 * Description of Action
 *
 * @author user
 */
class Action {
    public static function showFormAction()
    {
        \gmk\view\View::renderForm();
    }
    
    public static function newClientAction()
    {
        $r = Site::parseRNickname();
        //jeżeli brak błędów loginu
        if(empty($r['errors']))
        {
            //to spróbuj dołączyć klienta
            $r['errors'] = Client::newClient($r['nickname']);
        }
        
        //Jeżeli brak żadnych błędów
        //(brak nowych błędów próby dołączenia klienta)
        if(empty($r['errors']))
        {
            //TODO: lobby
            //TODO: wyświetlanie i obsluzenie lobby
        }
        else
        {
            \gmk\view\View::renderForm($r['errors']);
        }
    }
    
    
    public static function visitSiteAction()
    {
        if(isset($_GET['page'])  && $_GET['page'] == "clear")
        {
            session_destroy();
            echo "<h2> wyczyszczono sesje</h2>";
        }
        else
        {
            self::error(E_USER_ERROR, 404, "Nie znaleziono strony", "podana strona nie istnieje!");
        }
    }
    
    public static function error($level, $errno, $title, $description)
    {
        switch($level)
        {
            case E_CORE_ERROR :
                $level = "E_CORE_ERROR";
                break;
            default :
                $level = "E_UNRECOGNIZED";
        }
        \gmk\view\View::renderError($level, $errno, $title, $description);
    }
}
