<?php

namespace App\Controllers\Transit;

use App\Controllers\Transit\TransitsInterface;
use App\Controllers\Transit\Transit;

class Transits {//implements TransitsInterface {
    
    private $routeIndexes = [];
    private $instance;

    //getRouteIndexes
    public function __construct()
    {

        
        //if(empty($this->$routeIndexes))
        //var_dump((new Transit())->getRouteIndexes());
        var_dump(array_keys(get_object_vars(new Transit())));
    }
}
