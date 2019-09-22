<?php

class Portal
{
    private $dbo = null;

    public function __construct($host, $user, $pass, $db)
    {
        $this->dbo = $this->connect($host, $user, $pass, $db);  
    }

    public function connect($host, $user, $pass, $db)
    {
        if ($dbo = new PDO("mysql:host={$host};dbname={$db};charset=utf8", $user, $pass, [PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION])) {
            return $dbo;
        }
        else {
            return null;
        }
    }
}