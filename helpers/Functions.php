<?php

function isArrayNotEmpty(Array $data): bool
{
    return $data === [] ? false : true;
}

function isEmptyAssociativeArray(String $key, String $value): bool
{
    return (empty($key) || empty($value)) ? true : false;
}

function createURN(Array $associativeArray): String
{
    $URN = '';

        foreach ($associativeArray as $key => $value) {
            if(isEmptyAssociativeArray($key,$value))
                break;

            $URN.=('&'.$key.'='.$value);
        }

    return $URN;
}
