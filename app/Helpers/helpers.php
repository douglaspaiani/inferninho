<?php

use Carbon\Carbon;

function CalculateAge($date) {
    $birth = Carbon::parse($date);
    return $birth->age;
}