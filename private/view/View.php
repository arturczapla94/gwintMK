<?php

namespace gmk\view;

/**
 * 
 *
 * @author Artur
 */

require_once PTH_PRIVATE . DS .'view/DTemplate.php';


class View {
    
    public static function render($a)
    {
        DTemplate::sendHeaders("Gwint MK");
        
        DTemplate::sendMsgBox('action', $a['action']);
        
        DTemplate::sendBoard();
        
        DTemplate::sendClose();
        
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
        
    }
    
}
