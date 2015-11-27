<?php



namespace gmk\model;

/**
 * 
 *
 * @author user
 */
class DataManager {
    /**
     *
     * @var FileDataBase
     */
    public static $GeneralDM;
    
   
    
    public static function init()
    {
        //TODO: move to config, exception catch
        $dataController = new FileDataBase();
        
        self::$generalDM = $dataController;
    }
}
