<?php

namespace App\Controllers\Transit;

class Transit {

    private $UUID;
    /*
    private $from;
    private $to;
    */
    private $distance;
    private $formattedTime;
    private $realTime;
    private $fuelUsed;
    private $timestamp;

    public function __construct(Array $transitData = [])
    {
        if(isArrayNotEmpty($transitData)){
            $this->setUUID();
            
            isNotEmpty($distance = $transitData['distance']) ? $this->setDistane($distance) : 0;
            isNotEmpty($formattedTime = $transitData['formattedTime']) ? $this->setFormattedTime($formattedTime) : '';
            isNotEmpty($realTime = $transitData['realTime']) ? $this->setRealTime($realTime) : 0;
            isNotEmpty($fuelUsed = $transitData['fuelUsed']) ? $this->setFuelUsed($fuelUsed) : 0;
            $this->setTimestamp();
        }
    }
    
    private function setUUID(): void
    {
        $this->UUID = uuidv4();
    }
    /*
    private function setFrom(String $from): void
    {
        $this->from = $from;
    }

    private function setTo(String $to): void
    {
        $this->to = $to;
    }
    */
    private function setDistane(float $distance): void
    {
        $this->distance = $distance;
    }
    
    private function setFormattedTime(String $formattedTime): void
    {
        $this->formattedTime = $formattedTime;
    }

    private function setRealTime(int $realTime): void
    {
        $this->realTime = $realTime;
    }

    private function setFuelUsed(float $fuelUsed): void
    {
        $this->fuelUsed = $fuelUsed;
    }

    private function setTimestamp(): void
    {
        $this->timestamp = date('Y-m-d h:m:s');
    }
}