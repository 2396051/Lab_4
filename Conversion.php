<?php
require_once("classThermistor.php");

$Vadc = $_GET['Vadc'] ?? 2.5;
$Vcc  = $_GET['Vcc'] ?? 5;
$Rdiv = $_GET['Rdiv'] ?? 10;
$unit = $_GET['unit'] ?? "C";

$Ther = new Thermistor();
$Ther->setVadc($Vadc);
$Ther->setVcc($Vcc);
$Ther->setRdiv($Rdiv);

$temp = $Ther->calculTemperature();

if ($unit == "F") {
    $temp = ($temp * 9 / 5) + 32;
}
elseif ($unit == "K") {
    $temp = $temp + 273.15;
}

echo round($temp, 2) . " °" . $unit;
?>