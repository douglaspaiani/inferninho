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

function validCpf($cpf){
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) {
        return false;
    }
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

function validCreditCard($number) {
    $number = preg_replace('/[^0-9]/', '', $number);
    if (strlen($number) < 13 || strlen($number) > 19) {
        return false;
    }
    $sum = 0;
    $reverse = strrev($number);
    for ($i = 0; $i < strlen($reverse); $i++) {
        $digit = (int)$reverse[$i];
        if ($i % 2 == 1) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }
    return ($sum % 10 === 0);
}
function verifyExpireCard($date) {
    $date = explode('/', $date);
    $month_a = date('m');
    $year_a = date('y');
    $month = $date[0];
    $year = $date[1];

    if ($year > $year_a) {
        return true;
    }

    if ($year == $year_a && $month >= $month_a) {
        return true;
    }

    return false;
}

function verifyBrandCard($number){
    $number = preg_replace('/[^0-9]/', '', $number);
    $brands = [
        'Visa' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
        'MasterCard' => '/^5[1-5][0-9]{14}$/',
        'AmericanExpress' => '/^3[47][0-9]{13}$/',
        'DinersClub' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
        'Discover' => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
        'JCB' => '/^(?:2131|1800|35\d{3})\d{11}$/',
        'Elo' => '/^((((636368)|(438935)|(504175)|(451416)|(509048)|(509067)|(509049)|(509069)|(509050)|(509074)|(509068)|(509040)|(509045)|(509051)|(509046)|(509066)|(509047)|(509042)|(509052)|(509064)|(509041)|(509043)|(509065)|(509053)|(509044)|(509063))\d{10})|((5067)|(4576)|(4011))\d{12})$/',
        'Hipercard' => '/^(606282\d{10}(\d{3})?)|(3841\d{15})$/'
    ];

    foreach ($brands as $brand => $regex) {
        if (preg_match($regex, $number)) {
            return $brand;
        }
    }

    return 'Bandeira desconhecida';
}

function FormatContent($content){
    $content = preg_replace('/[0-9]/', '*', $content);
    $content = preg_replace('/\b(?:https?:\/\/|www\.)\S+\b/', '', $content);

    return $content;
}
function stringPhone($numero){
    $num = str_replace('(', '', $numero);
    $num = str_replace(')', '', $num);
    $num = str_replace(' ', '', $num);
    $num = str_replace('-', '', $num);
    return $num;

}