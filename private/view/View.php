<?php

namespace gmk\view;

/**
 * 
 *
 * @author Artur
 */

require_once PTH_PRIVATE . DS .'view/DTemplate.php';


class View {
    
    public static function render()
    {
        DTemplate::sendHeaders("Gwint MK");
        
        DTemplate::sendBoard();
        
        DTemplate::sendClose();
        
    }
    
}
