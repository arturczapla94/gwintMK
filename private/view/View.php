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
    
    public static function render($a)
    {
        DTemplateBasic::sendBasicHeaders(array('title'=>"Gwint MK"));
        
        DTemplateBasic::sendMsgBox('action', $a['action']);
        
        DTemplateBoard::sendBoard();
        
        DTemplateBasic::sendClose();
        
    }
    
    
    
    public static function renderError($data)
    {
        DTemplate::sendHeaders(\gmk\site\Site::SITE_NAME);
        
        DTemplate::sendMsgBox('Internal Error / Błąd wewnętrzny',
                "<pre>".print_r($data['errors'], true)."</pre>");
        
        DTemplate::sendClose();
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
