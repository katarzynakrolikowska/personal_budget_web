<?php

class ChartGenerator
{
    private $dataPoints = null;

    public function __construct()
    {
        $this -> dataPoints = array();
    }

    public function setDataPoint($point)
    {
        array_push($this -> dataPoints, $point);
    }

    public function getDataPoints()
    {
        return $this -> dataPoints;
    }
}