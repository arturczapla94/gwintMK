<?php


namespace gmk\site;


require_once (PTH_PRIVATE.DS.'model/interfaces/GeneralDI.php');
require_once (PTH_PRIVATE.DS.'model/interfaces/PlayerListDI.php');
/**
 * 
 *
 * @author Artur
 */
class Client {

    //Maksymalna liczba podłączonych do systemu użytkowników 
    const MAX_ALL_PLAYERS = 200;
    
    
    public static function isRegistered()
    {
        if(isset($_SESSION['playing']) && $_SESSION['playing'] >= 1)
        {
            return true;
        }
        return false;
    }
    
    /**
     * Dodaje do systemu nowego użytkownika, przydziela id
     */
    public static function newClient()
    { 
        $errors = array();
        //TODO sprawdzenie poprawności odczytywania bazys
        /*Model::read();
        $allPlayers = Model::getVar("allPlayersCount", 0);*/
        if(\gmk\model\GeneralDI::connect() != true)
        {
            $errors[] = array(15, "otherE",
                "Nie udało się połączyć");
            return $errors;
        }
        \gmk\model\GeneralDI::mget("allPlayersCount");
        
        if(\gmk\model\GeneralDI::process() < 0 )
        {
            $errors[] = array(16, "otherE",
                "Nie udało się pobrać lub zapisać danych");
            \gmk\model\GeneralDI::close();
            return $errors;
        }
        
        $allPlayers = isset(\gmk\model\GeneralDI::$buffer['allPlayersCount']) ?
                \gmk\model\GeneralDI::$buffer['allPlayersCount'] : 0;
        
        if($allPlayers >= self::MAX_ALL_PLAYERS)
        {
            $errors[] = array(11, "too_many_players",
                "Osiągnięto maksymalną liczbę graczy!");
            return $errors;
        }
        \gmk\model\GeneralDI::mset("allPlayersCount", $allPlayers + 1);
        
        if(\gmk\model\GeneralDI::process() < 0 )
        {
            $errors[] = array(16, "otherE",
                "Nie udało się zapisać danych");
            \gmk\model\GeneralDI::close();
            return $errors;
        }
        \gmk\model\GeneralDI::close();
        
        /*Model::setVar("allPlayersCount", $allPlayers+1);
        $r = Model::save();*/
        
        if(!$r)
        {
            $errors[] = array(13, "save_data_error",
                "nie udało się zapisać bazy danych systemowych");
            return $errors;
        }
        
        $_SESSION['playing'] = 1;
        //$players = Model::getVar("players", array() );
        
        //TODO: obsługiwanie brak wolnego id
        //Szukanie wolnego idetyfikatora dla gracza
        \gmk\model\PlayerListDI::connect();
        \gmk\model\PlayerListDI::getFreeID();
        \gmk\model\PlayerListDI::connect();
        
        ^&*(*&^%$^&*);
        // player identificator
        $pid = 1;
        while(!empty($players[$pid]) )
        {
            $pid++;
        }
        
        $players[$pid] = array("sid" => session_id() );
        $_SESSION['pid'] = $pid;
        //Model::setVar("players", $players);
        
        /*if(!Model::save())
        {
            $errors[] = array(13, "save_data_error",
                "nie udało się zapisać bazy danych systemowych");
            return $errors;
        }*/
        
        //echo 'nowa gra, gracz: '.$pid. '   session id: '.session_id()."</br>".PHP_EOL;
        
        return TRUE;
    }
    
    public static function resumeClient()
    {
        $r = Model::read();
        if(!$r)
        {
            echo "błąd 033a - nie udało się wczytać bazy danych systemowych<br>".PHP_EOL;
            var_dump($r);
            return FALSE;
        }
        $players = Model::getVar("players", array() );
        echo ($_SESSION['pid']);
        echo "<pre>";
        print_r($players);
        echo "</pre>";
        if(!array_key_exists($_SESSION['pid'], $players) )
        {
            echo "błąd 034 - błąd wczytywania, brak takiego player id w bazie jak w sesji<br>".PHP_EOL;
            return FALSE;
        }
        $player = $players[ $_SESSION['pid'] ];
        
        echo 'ressumed player: '.$_SESSION['pid'].", sid: ".$player['sid']."   sessionid: ".session_id().PHP_EOL;
        return true;
    }
    
    public static function clearClient()
    {
        $r = Model::read();
        if($r)
        {
            $players = Model::getVar("players", array() );
            if(array_key_exists($_SESSION['pid'], $players) )
            {
                unset($players[$_SESSION['pid']]);
                Model::setVar("players", $players);
                Model::save();
            }
        }
        unset ($_SESSION['pid']);
        unset ($_SESSION['playing']);

        return true;   
    }
    
    
    public static function isPlaying()
    {
        //TODO: isPlayin()
        return false;
    }
    
    public static function resumeGame()
    {
        //TODO: resumeGame()
        return true;
    }
}
