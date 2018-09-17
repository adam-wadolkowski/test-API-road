<?php

declare(strict_types=1);
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once('vendor/autoload.php');

use App\Models\Provider\Provider;
use App\Controllers\Transit\Transits;

$urlOptions = ['from' => 'Denver%2C+CO', 'to' => 'Chicago'];

$provider = new Provider($urlOptions);
$providerData = $provider->getTransitData();
$transits = new Transits($providerData);
$data = $transits->getTransits();
var_dump($data);