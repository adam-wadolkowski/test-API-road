<?php

namespace App\Controllers\Transit;

class Transit {

    private $UUID;
    private $from;
    private $to;
    private $distance;
    private $time;
    private $timestamp;

    public function __construct(Array $transitData = [])
    {
        if(isArrayNotEmpty($transitData)){

        }
    }
    
    private function setUUID(): void
    {
        $this->UUID = uuidv4();
    }

    private function setFrom(String $from): void
    {
        $this->from = $from;
    }

    private function setTo(String $to): void
    {
        $this->to = $to;
    }

    private function setDistane(float $distance): void
    {
        $this->distance = $distance;
    }
    
    private function setTime(String $time): void
    {
        $this->time = $time;
    }

    private function setTimestamp(): void
    {
        $this->timestamp = date('Y-m-d h:m:s');
    }
    /*
    private function getRouteIndexes(): Array
    {   
        return array_keys(get_object_vars($this));
    }
    */
}