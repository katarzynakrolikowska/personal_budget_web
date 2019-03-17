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
        $i = 1;
        foreach ($parametersToBind as $key => $value) {
            $command -> bindValue($i, $key, $value);
            $i ++;
        }
        $command -> execute();
        return $command -> fetchAll();
    }

    public function executeQuery($query, $parametersToBind)
    {
        $command = $this -> dbo -> prepare($query);
        $i = 1;
        foreach ($parametersToBind as $key => $value) {
            $command -> bindValue($i, $key, $value);
            $i ++;
        }
        $command -> execute();
    }

}