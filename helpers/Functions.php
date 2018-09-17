<?php

function isArrayNotEmpty(Array $data): bool
{
    return $data === [] ? false : true;
}

function isNotEmpty($data): bool
{
    return empty($data) ? false : true;
}

function isEmptyKeyOrValue(String $key, String $value): bool
{
    return (empty($key) || empty($value)) ? true : false;
}

function createURN(Array $associativeArray): String
{
    $URN = '';

        foreach ($associativeArray as $key => $value) {
            if(isEmptyKeyOrValue($key,$value))
                break;

            $URN.=('&'.$key.'='.$value);
        }

    return $URN;
}

function uuidv4()
{
    $data = random_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
