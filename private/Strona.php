<?php

/*
 * 
 */

/**
 * 
 *
 * @author Artek
 */

require_once ('private/Model.php');

class Strona {
    
    const MAX_ALL_PLAYERS = 200;
    
    public function newPlayer()
    { 
        Model::read();
        $allPlayers = Model::getVar("allPlayersCount", 0);
       
        if($allPlayers >= self::MAX_ALL_PLAYERS)
        {
            
            echo "błąd 032 - przekroczono max liczbe graczy<br>".PHP_EOL;
            return FALSE;
        }
        Model::setVar("allPlayersCount", $allPlayers+1);
        $r = Model::save();
        
        if(!$r)
        {
            echo "błąd 031 - nie udało się zapisać bazy danych systemowych<br>".PHP_EOL;
            return FALSE;
        }
        
        $_SESSION['playing'] = 1;
        $players = Model::getVar("players", array() );
        
        // player identificator
        $pid = 1;
        while(!empty($players[$pid]) )
        {
            $pid++;
        }
        
        $players[$pid] = array("sid" => session_id() );
        $_SESSION['pid'] = $pid;
        Model::setVar("players", $players);
        
        if(!Model::save())
        {
            echo "błąd 031 - nie udało się zapisać bazy danych systemowych<br>".PHP_EOL;
            return FALSE;
        }
        
        echo 'nowa gra, gracz: '.$pid. '   session id: '.session_id()."</br>".PHP_EOL;
        
        return TRUE;
    }
    
    public function resumePlayer()
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
        var_dump($players );
        if(!array_key_exists($_SESSION['pid'], $players) )
        {
            echo "błąd 034 - błąd wczytywania, brak takiego player id w bazie jak w sesji<br>".PHP_EOL;
            return FALSE;
        }
        $player = $players[ $_SESSION['pid'] ];
        
        echo 'ressumed player: '.$_SESSION['pid'].", sid: ".$player['sid']."   sessionid: ".session_id().PHP_EOL;
        return true;
    }
    
    public function clearPlayer()
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
}
