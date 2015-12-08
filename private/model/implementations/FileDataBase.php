<?php


namespace gmk\model;

require_once (PTH_PRIVATE.DS.'model/helpers/DBInterface.php');
require_once (PTH_PRIVATE.DS.'site/Site.php');

/**
 * 
 *
 * @author Artur Czapla
 */
class FileDataBase extends DBInterface{
    
    const BASE_FOLDER = "data";
    const FILE_EXTENSION = "dat";
    const DELIMITER = "=";
    
    protected $filename = [];
    protected $readable = [];
    protected $buffers  = [];
    protected $isBuffered = [];
    protected $toGet      = [];
    protected $savebuffer = [];
    
    
    /**
     * Nawiązuje połączenie z zasobem danych dla danej tabeli danych
     * @param string $table
     * @return boolean
     */
    public function connect($table, &$buffer = null)
    {
        $filename = false;
        switch ($table)
        {
            case "general" :
            case "playerlist" :
                $filename = $table;
            
        }
        
        if(array_key_exists($table, $this->readable))
        {
            if($this->readable[$table]!==false)
            {
                \gmk\site\Site::logError(10,"Już nawiązano połączenie z tą tabelą", E_WARNING);
                return true;
            }
        }
        
        if(empty($filename))
        {
            \gmk\site\Site::logError(10,"Odwołanie do nie istniejącej tabeli danych", E_ERROR);
            return false;
        }
        
        $path = PTH_PRIVATE.DS.self::BASE_FOLDER.DS . $filename . ".".self::FILE_EXTENSION;
        $this->filename[$table] = $path;
        
        if(file_exists ($path) )
        {
            if(!is_readable($path))
            {
                \gmk\site\Site::logError(10,"Brak uprawnień do pliku", E_ERROR);
                $this->readable[$table] = false;
                return false;
            }
            
            $this->readable[$table] = true;
            $this->buffers[$table] = array();
            
        }
        else
        {
            //$this->buffers[$table] = array();
            $this->isBuffered[$table] = true;
            $handle = fopen($path,"w");
            if($handle === false)
            {
                $this->readable[$table] = false;
                \gmk\site\Site::logError(10,"Brak uprawnień do stworzenia pustego pliku bazy danych", E_WARNING);
            }
            else
            {
                fclose($handle);
                $this->readable[$table] = true;
            }
            return true;
        }
        
        
        return true;
    }
    
    /**
     * wykonuje operacje dla tabeli danych
     * @param string $table nazwa tabeli danych
     * @return int Zwraca 0 dla powodzenia, -2 nie ma operacji do zrobienia,
     * -11 działanie na nie otwartym zasobie, -12 błąd w trakcie odczytywania zasobu
     */
    public function process ($table, &$buffer)
    {
        if(empty($this->readable[$table]))
        {
            \gmk\site\Site::logError(10,"brak uprawnien lub nie sprawdzono!", E_ERROR);
            return -11;
        }
        
        if(empty($this->toGet[$table]) && empty($this->savebuffer[$table]))
        {
            \gmk\site\Site::logError(10,"Nic do zrobienia", E_WARNING);
            return -2;
        }
        
        
        if(empty($this->isBuffered[$table]))
        {
            if( ! $this->loadFlatFile($this->filename[$table], $buffer) )
            {
                \gmk\site\Site::logError(10,"błąd odczytu!", E_ERROR);
                return -12;
            }
            $this->buffers[$table] = &$buffer;
            $this->isBuffered[$table] = true;
            
        }
        unset($this->toGet[$table]);
        
        if(!empty($this->savebuffer[$table]))
        {
            foreach($this->savebuffer[$table] as $key => $val)
            {
                $this->buffers[$table][$key] = $val;
            }
            $r = self::writeFlatFile($this->filename[$table], $this->buffers[$table] );
            if(!$r)
            {
                \gmk\site\Site::logError(10,"błąd zapisu", E_ERROR);
                return false;
            }
            
            unset($this->savebuffer[$table]);
            
        }
        
        return true;
        
    }
    
    /**
     * Zamyka zasób danych (rozłączenie z bazą, )
     * @param string $table nazwa tabeli
     * @return boolean
     */
    public function close($table)
    {
        $this->isBuffered[$table] = false;
        return true;
    }
    
    public function setBuffer($table, &$buffer)
    {
        if ($this->readable[$table] !== true )
        {
            //TODO log error
            return false;
        }
        if ($this->isBuffered[$table] === true )
        {
            //TODO log error
            return false;
        }
    }
    
    /**
     * Zpisuje klucze do odczytu z zasobu danych
     * @param string $table
     * @param array $key
     */
    public function mget($table, $key)
    {
        $this->toGet[$table][] = $key;
    }
    
    
    public function mset($table, $key, $value)
    {
        if(!empty($this->isBuffered[$table]))
        {
            $this->buffers[$table][$key] = $value;
        }
        $this->savebuffer[$table][$key]=$value;
    }
    
    public function loadAll($table)
    {
        throw new \BadMethodCallException("not implemented yet");
    }
    
    ///////////////////////////////////////
    //  Obsługa PlayerListDI
    
    public function getFreePlayerID()
    {
        
        
        
    }
    
    
    //////////////////////////////////////
    //////////////////////////////////////
    
    protected static function loadFlatFile( $path,  &$target)
    {
        $handle = fopen($path, "r");
        
        $target = [];
        while (($buffer = fgets($handle, 512)) !== false)
        {
            
            $a = explode(self::DELIMITER,trim($buffer));
            if (count($a)>=2)
            {
                $target[$a[0]] = is_numeric($a[1]) ? intval($a[1]) : $a[1] ;
            }
        }
        if (!feof($handle))
        {
            //TODO: obsługa przerwania odczytawania pliku, poprawa nr błędów
            \gmk\site\Site::logError(10,"Błąd w trakcie czytania plików", E_ERROR);
            //echo "Error: unexpected fgets() fail\n";
            fclose($handle);
            return false;
        }
        fclose($handle);
        return true;
    }
    
    protected static function writeFlatFile( $path,  &$source)
    {
        $handle = fopen($path, "w");
        
        if($handle === false)
        {
            return false;
        }
        
        foreach($source as $key => $val)
        {
            fwrite($handle, $key.self::DELIMITER. $val.PHP_EOL);
        }
        
        fclose($handle);
        
        return true;
    }
    
    protected static function loadDataFile($path, &$target)
    {
        $res = file_get_contents($path);
        if ($res === false)
        {
            \gmk\site\Site::logError(16,"błąd odczytu pliku", E_ERROR);
            return false;
        }
        $target = unserialize($res);
        return true;
    }
    
}
