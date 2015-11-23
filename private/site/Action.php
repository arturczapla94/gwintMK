<?php


namespace gmk\site;

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
    
    public static function error($level, $errno, $title, $description)
    {
        \gmk\view\View::renderError($level, $errno, $title, $description);
    }
}
