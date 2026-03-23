<?php
require_once("classThermistor.php");

$Vadc = $_GET['Vadc'] ?? 2.5;
$Vcc  = $_GET['Vcc'] ?? 5;
$Rdiv = $_GET['Rdiv'] ?? 10;

$Ther = new Thermistor();
$Ther->setVadc($Vadc);
$Ther->setVcc($Vcc);
$Ther->setRdiv($Rdiv);

$temp = $Ther->calculTemperature("C");

//echo "Température = " . round($temp, 2) . " °C";

echo round($temp, 2);
?>