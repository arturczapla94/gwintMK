<?php



namespace gmk\model;


require_once (PTH_PRIVATE.DS.'model/implementations/FileDataBase.php');
/**
 * 
 *
 * @author Artur Czapla
 */
class DataManager {
    
    /**
     * @var FileDataBase
     */
    public static $generalDC;
    /**
     * @var type FileDataBase
     */
    public static $playerListDC;
   
    
    public static function init()
    {
        //TODO: move to config, exception catch
        $dataController = new FileDataBase();
        
        self::$generalDC = $dataController;
        self::$playerListDC = $dataController;
    }
}
