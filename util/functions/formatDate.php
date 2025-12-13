<?php

function castDate($date, $updatedAt = false){
    if(!isset($date)) return ;
    
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    $puredate = explode(" ", $date)[0];
    $day = explode('-', $puredate)[2];
    $month = explode('-', $puredate)[1];
    $year = explode('-', $puredate)[0];

    return $updatedAt ? "lastly updated on {$months[$month - 1]} $day, $year" : "created on {$months[$month - 1]} $day, $year";
}