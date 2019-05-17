<?php

class MyDB
{
    private $dbo = null;

    public function __construct($dbo)
    {
        $this -> dbo = $dbo;
    }

    public function getQueryResult($query, $parametersToBind)
    {
        $command = $this -> dbo -> prepare($query);
        foreach ($parametersToBind as $name => $value) {
            $command -> bindValue($name, $value);
        }
        $command -> execute();
        
        return $command -> fetchAll();
    }

    public function executeQuery($query, $parametersToBind)
    {
        $command = $this -> dbo -> prepare($query);
        foreach ($parametersToBind as $name => $value) {
            $command -> bindValue($name, $value);
        }
        $command -> execute();
    }
}