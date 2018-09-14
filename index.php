<?php

declare(strict_types=1);
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once('vendor/autoload.php');

use App\Models\Provider\Provider;


$urlOptions = ['from' => 'Denver%2C+CO','to' => 'Boulder%2C+CO','outFormat' => 'json'];

$provider = new Provider($urlOptions);
var_dump($provider);
//$transitData = $provider->getTransitData();