<?php

namespace App\Models\Provider;

use App\Models\Provider\ProviderInterface;
use Exception;

class Provider implements ProviderInterface {

    private $httpSuccessCodes = [200,202];
    private $apiSettings = ['key' => 'EvsnNn2Q5CvsxEvDNe5FDA79V9NRayhU','routeType' => 'shortest', 'unit' => 'k'];
    private $connectionOptions = [
        CURLOPT_URL => 'http://www.mapquestapi.com/directions/v2/route?',
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true
    ];

    public function __construct(Array $additionalsURLOptions = [])
    {   
        
        if($this->isSetKeyApi()){
            $URL = $this->updateURLConnection($this->apiSettings);
            $this->setConnectionOptions([CURLOPT_URL => $URL]);
        }
        else
            echo 'TO DO - get api settings from config file .env';
        
        if(isArrayNotEmpty($additionalsURLOptions)) {

            $URL = $this->updateURLConnection($additionalsURLOptions);

            $this->setConnectionOptions([CURLOPT_URL => $URL]);
        }
    }

    private function isSetKeyApi(): bool
    {
        return empty($this->apiSettings['key']) ? false : true; 
    }

    private function updateURLConnection(Array $data): String 
    {
        $URL = $this->getConnectionOption(CURLOPT_URL);
        $URL .= createURN($data);

        return $URL;
    }

    private function getHttpSuccessCodes(): Array
    {
        return $this->httpSuccessCodes;
    }

    private function setConnectionOptions(Array $newOptions): void
    {
        foreach ($newOptions as $key => $value) {
            if(array_key_exists($key, $this->connectionOptions))
                $this->connectionOptions[$key] = $value;
        }
    }

    private function getConnectionOption(String $index = ''): String
    {
        if(array_key_exists($index, $this->connectionOptions))
            return $this->connectionOptions[$index];
        else
            return '';
    }

    private function getConnectionOptions(Array $indexes = []): Array
    {   
        if(empty($indexes))
            return $this->connectionOptions;
        else
            return [];
    }

    private function isFaultRequest(int $curlResponseCode)
    {   
        if(in_array($curlResponseCode,$this->getHttpSuccessCodes()))
            return false;
        else
            return true;
    }

    private function requestResponseCurl(): Array
    {
        try
        {
            $curl = curl_init();

            curl_setopt_array($curl, $this->getConnectionOptions());

            $curlResultRequest = curl_exec($curl);

            if (!$curlResultRequest) {
                throw new Exception('Error: ' . curl_error($curl));
            }

            $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($this->isFaultRequest($responseCode)) {
                throw new Exception("Warning: Response code: {$responseCode}. {$curlResultRequest}");
            }
            
            $responseData = json_decode($curlResultRequest,TRUE);

            if(isNotEmpty($responseData['info']['statuscode'])) {
                if($this->isFaultRequest($responseData['info']['statuscode'])) {
                    throw new Exception(implode(" ", $responseData['info']['messages']));
                }
            }

            //$responseData['connection']['time'] = round(curl_getinfo($curl, CURLINFO_CONNECT_TIME),2);

            curl_close($curl);
        }
        catch (Exception $e) {
            return ['message' => $e->getMessage()];
        }
            return $responseData['route'];
    }

    public function getTransitData(): Array
    {   
        return $this->requestResponseCurl();
    }
}
