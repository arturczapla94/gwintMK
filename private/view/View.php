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
    
    public static function render($show)
    {
        //TODO: show
        /*
        DTemplateBasic::sendBasicHeaders(array('title'=>"Gwint MK"));
        
        DTemplateBasic::sendMsgBox('action', $a['action']);
        
        DTemplateBoard::sendBoard();
        
        DTemplateBasic::sendClose();*/
        
    }
    
    
    
    public static function renderError($level, $errno, $title, $description)
    {
        DTemplateBasic::openHTML();
        DTemplateBasic::sendBasicHeaders(['title'=> "Błąd wewnętrzny",
                                          'css'  => array('others'), 
                                          'js'   => array() ] );
        DTemplateBasic::closeHead();
        DTemplateOther::sendErrorSite($level, $errno, $title, $description);
        DTemplateBasic::closeHTML();
    }
    
    public static function renderForm($errors=array())
    {
        DTemplateBasic::openHTML();
        DTemplateBasic::sendBasicHeaders(['title'=> "GwintMK",
                                          'css'  => array('form'), 
                                          'js'   => array()] );
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
