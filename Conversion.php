<?php
require_once("classThermistor.php");

$Vadc = $_GET['Vadc'];
$Vcc  = $_GET['Vcc'];
$Rdiv = $_GET['Rdiv'];  
echo"Vadc: $Vadc <br>";
$Ther = new Thermistor($Vcc, $Rdiv, $Vadc);

$Ther->vcc=5;
$Ther->Rdiv=5;
$Ther->Vadc=$Vadc;


$temp=$Ther->calculTemperature();

echo "Temperature = " . $temp . " °C";
?>   