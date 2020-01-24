<?php

$dow   = 'saturday';
$step  = 2;
$unit  = 'W';
$date = date("Y-m-d");
$start = new DateTime($date);
$end   = clone $start;

$start->modify($dow); // Move to first occurence
$end->add(new DateInterval('P1Y')); // Move to 1 year from start

$interval = new DateInterval("P{$step}{$unit}");
$period   = new DatePeriod($start, $interval, $end);

foreach ($period as $date) {
    echo $date->format('D, d M Y')."</br>";
}


?>