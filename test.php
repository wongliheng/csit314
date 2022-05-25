<?php
session_start();

date_default_timezone_set("Asia/Singapore"); 
$timestamp = date("Y-m-d H:i");
$day = date("d");
$month = date("m");
$hour = date("H");
$minute = date("i");


echo $day;
echo "<br>";

echo $month;
echo "<br>";

echo $hour;
echo "<br>";

echo $minute;
echo "<br>";

if ($day <= 7) {
    $week = 1;
} else if ($day > 7 && $day <= 14) {
    $week = 2;
} else if ($day > 14 && $day <= 21) {
    $week = 3;
} else if ($day > 21 && $day <= 28) {
    $week = 4;
} else {
    $week = 5;
}

echo $week;
echo "<br>";

echo $timestamp;
echo "<br>";

echo "<br>";echo "<br>";echo "<br>";

// 1635 - 1735
$duration = 0;
$startMinute = 35;
$minute = 35;
$startHour = 16;
$hour = 17;
if ($minute > $startMinute) {
    $duration = $minute - $startMinute;
} else {
    $duration = $minute + (60 - $startMinute);
}

if ($hour > $startHour && $minute > $startMinute) {
    $duration = $duration + ($hour - $startHour);
}

echo $duration;
echo "<br>";

// 1420 - 1455
$duration = 0;
$startMinute = 20;
$minute = 55;
$startHour = 14;
$hour = 14;
if ($minute > $startMinute) {
    $duration = $minute - $startMinute;
} else {
    $duration = $minute + (60 - $startMinute);
}

if ($hour > $startHour && $minute > $startMinute) {
    $duration = $duration + ($hour - $startHour);
}

echo $duration;
echo "<br>";

// 1550 - 1610
$duration = 0;
$startMinute = 50;
$minute = 10;
$startHour = 15;
$hour = 16;
if ($minute > $startMinute) {
    $duration = $minute - $startMinute;
} else {
    $duration = $minute + (60 - $startMinute);
}

if ($hour > $startHour && $minute > $startMinute) {
    $duration = $duration + ($hour - $startHour);
}

echo $duration;
echo "<br>";

// 1530 - 1720 (110)
$duration = 0;
$startMinute = 30;
$minute = 20;
$startHour = 15;
$hour = 17;
if ($minute > $startMinute) {
    $duration = $minute - $startMinute;
} else {
    $duration = $minute + (60 - $startMinute);
}

if ($hour > $startHour && $minute > $startMinute) {
    $duration = $duration + (($hour - $startHour) * 60);
} else if ($hour > $startHour && $minute < $startMinute) {
    $duration = $duration + (($hour - $startHour - 1) * 60);
}

echo $duration;
echo "<br>";

// 1530 - 1740 (130)
$duration = 0;
$startMinute = 30;
$minute = 40;
$startHour = 15;
$hour = 17;
if ($minute > $startMinute) {
    $duration = $minute - $startMinute;
} else {
    $duration = $minute + (60 - $startMinute);
}

if ($hour > $startHour && $minute > $startMinute) {
    $duration = $duration + (($hour - $startHour) * 60);
} else if ($hour > $startHour && $minute < $startMinute) {
    $duration = $duration + (($hour - $startHour - 1) * 60);
}

echo $duration;
echo "<br>";

echo "<br>";
echo $_SESSION['startHour'];
echo $_SESSION['startMinute'];

echo "<br>";
// 1530 - 1530 (0)
$duration = 0;
$startMinute = 30;
$minute = 30;
$startHour = 15;
$hour = 15;
if ($minute > $startMinute) {
    $duration = $minute - $startMinute;
} else {
    $duration = $minute + (60 - $startMinute);
}

if ($hour > $startHour && $minute > $startMinute) {
    $duration = $duration + (($hour - $startHour) * 60);
} else if ($hour > $startHour && $minute < $startMinute) {
    $duration = $duration + (($hour - $startHour - 1) * 60);
} else if ($hour = $startHour && $minute = $startMinute) {
    $duration = 1;
}
echo $duration;
echo "<br>";
echo "<br>";echo "<br>";echo "<br>";

$object1 = '{"100Plus":"1","Coke":"1"}';
$object2 = '{"Coke":"1","100Plus":"1"}';

$o1 = json_decode($object1);
$o2 = json_decode($object2);

$x = array();

foreach ($o1 as $key => $value) {
    if (!array_key_exists($key, $x)) {
        $x[$key] = $value;
    } else {
        $quantity = $x[$key];
        $quantity = $quantity + $value;
        $x[$key] = $quantity;
    }
}

foreach ($o2 as $key => $value) {
    if (!array_key_exists($key, $x)) {
        $x[$key] = $value;
    } else {
        $quantity = $x[$key];
        $quantity = $quantity + $value;
        $x[$key] = $quantity;
    }
}

print_r($x);