<?php

use Carbon\Carbon;

function CalculateAge($date) {
    $birth = Carbon::parse($date);
    return $birth->age;
}

function ConvertRealToFloat($value){
    if(empty($value)){
        return null;
    }
    $value = str_replace('.', '', $value);
    $value = str_replace(',', '.', $value);
    return $value;
}