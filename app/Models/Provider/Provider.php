<?php

namespace App\Models\Provider;

use App\Models\Provider\ProviderInterface;
use Exception;

class Provider implements ProviderInterface {

    private $httpSuccessCodes = [200,202];
    private $apiKey = ['key' => 'EvsnNn2Q5CvsxEvDNe5FDA79V9NRayhU'];
    private $connectionOptions = [
        CURLOPT_URL => 'http://www.mapquestapi.com/directions/v2/route?',
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true
    ];

    public function __construct(Array $additionalsUrlOptions = [])
    {
        if(isArrayNotEmpty($additionalsUrlOptions)){
            $URL = $this->getConnectionOption(CURLOPT_URL);
            //to do - loading API key from file
            /*
            if(empty($this->apiKey['key']))
                echo 'lad';
            else
            */
                $additionalsUrlOptions = array_merge($this->apiKey,$additionalsUrlOptions);

            $URL .= createURN($additionalsUrlOptions);

            $this->setConnectionOptions([CURLOPT_URL => $URL]);
        }
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
        //$jsonResponseData = file_get_contents($url);
        try
        {
            $curl = curl_init();

            curl_setopt_array($curl, $this->getConnectionOptions());

            $curlResultRequest = curl_exec($curl);

            if (!$curlResultRequest) {
                throw new Exception('Error: ' . curl_error($curl));
            }

            $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $responseData = json_decode($curlResultRequest,TRUE);
            
            if ($this->isFaultRequest($responseCode)) {
                throw new Exception("Waring: Response code: {$responseCode}. Info: {$responseData['data']['name']}. Message: {$responseData['data']['message']}");
            }
            
            //$responseData['connection']['time'] = round(curl_getinfo($curl, CURLINFO_CONNECT_TIME),2);

            curl_close($curl);
        }
        catch (Exception $e) {
            return ['message' => $e->getMessage()];
        }
        
            return $responseData['data'];
    }

    public function getTransitData(): Array
    {   
        return $this->requestResponseCurl();
    }
}
