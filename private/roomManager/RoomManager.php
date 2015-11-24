<?php

namespace gmk\roomManager;

/**
 * 
 *
 * @author user
 */
class RoomManager {
    
    private static $isBuffered = false;
    
    public static function getEmptyRoomList()
    {
        if(!self::$isBuffered)
        {
           
        }
    }
    
    /**
     * @return array Zwraca tablice z pokojami(stołami) gdzie pokój reprezentowany
     * jest przez tablice asocjacyjną: <br />
     * {<br />
     * &nbsp;  int 'id' <br />
     * &nbsp;  int 'p1id' - player 1 id<br />
     * &nbsp;  int 'p2id' - player 2 id <br />
     * &nbsp;  'created' <br />
     * }
     */
    public static function getAllRoomList()
    {
        
    }
    
    public static function bufferRoomList()
    {
        
    }
    
}
