<?php

declare(strict_types=1);
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once('vendor/autoload.php');

use App\Models\Provider\Provider;
use App\Controllers\Transit\Transits;


$urlOptions = ['from' => 'Denver%2C+CO', 'to' => 'Boulder%2C+CO','outFormat' => 'json','routeType' =>'shortest', 'unit' => 'k' ];

$provider = new Provider($urlOptions);
$providerData = $provider->getTransitData();
//var_dump($providerData);
$transits = new Transits();
