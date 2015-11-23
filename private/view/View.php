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
        DTemplate::sendHeaders(\gmk\site\Site::SITE_NAME);
        DTemplateBasic::sendBasicHeaders(array('css'=>array('others'), 
                                                'title' => "Błąd wewnętrzny",
                                                'js'=>array()) );
        DTemplateBasic::closeHead();
        DTemplate::sendErrorBox($level, $errno, $title, $description);
        
        
        DTemplateBasic::closeHTML();
    }
    
    public static function renderForm()
    {
        DTemplateBasic::openHTML();
        DTemplateBasic::sendBasicHeaders(array('css'=>array('form'), 
                                                'title' => "GwintMK",
                                                'js'=>array()) );
        DTemplateBasic::closeHead();
        DTemplateOther::sendForm();
        DTemplateBasic::closeHTML();
        
    }
    
    
    public static function genRelativeLink($type)
    {
        if($type = "form")
        {
            return "index.php";
        }
    }
}
