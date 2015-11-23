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
        $errors = Site::parseRNickname();
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
