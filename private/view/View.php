<?php

namespace gmk\view;

/**
 * 
 *
 * @author Artur
 */

require_once PTH_PRIVATE . DS .'view/DTemplateBasic.php';
require_once PTH_PRIVATE . DS .'view/DTemplateBoard.php';
require_once PTH_PRIVATE . DS .'view/DTemplateOther.php';


class View {
    
      
    
    public static function renderError($level, $errno, $title, $description)
    {
        DTemplateBasic::openHTML();
        DTemplateBasic::sendBasicHeaders(array('css'=>array('others'), 
                                                'title' => "Błąd wewnętrzny",
                                                'js'=>array()) );
        DTemplateBasic::closeHead();
        DTemplateOther::sendErrorSite($level, $errno, $title, $description);
        DTemplateBasic::closeHTML();
    }
    
    public static function renderForm($errors=array())
    {
        DTemplateBasic::openHTML();
        DTemplateBasic::sendBasicHeaders(array('css'=>array('form'), 
                                                'title' => "GwintMK",
                                                'js'=>array()) );
        DTemplateBasic::closeHead();
        DTemplateOther::sendForm($errors);
        DTemplateBasic::closeHTML();
        
    }
    
    
    public static function genRelativeLink($type)
    {
        if($type == "form")
        {
            return "index.php";
        }
    }
}
