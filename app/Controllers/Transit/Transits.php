<?php

namespace App\Controllers\Transit;

//use App\Controllers\Transit\TransitsInterface;
use App\Controllers\Transit\Transit;

class Transits implements TransitsInterface {
    
    private $routeIndexes = ['distance','formattedTime','realTime','fuelUsed'];
    private $instance;
    private $errorMassage;

    public function __construct(Array $transitData = [])
    {
        if(empty($transitData['message'])) {

            $saveTransitData = [];
            foreach ($this->routeIndexes as $index) {
                $saveTransitData[$index] = $transitData[$index];
            }
            $this->instance[] =  new Transit($saveTransitData);
        }
        else
            $this->errorMassage = $transitData;
    }
    
    public function getTransits(): Array
    {
        return empty($this->instance) ? $this->errorMassage : $this->instance;
    }
}
