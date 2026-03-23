<?php

class Thermistor{

//propriétés
protected $Vcc;
protected $Vadc;
protected $Rt;
Protected $Rdiv;
private $tblConvert = array( array(111.3, -30.0), array(86.39, -25),
array( 67.74, -20 ), array( 53.39, -15 ), array( 42.45, -10 ),
array( 33.89, -5 ), array( 27.28, 0 ), array( 22.05, 5 ),
array( 17.96, 10 ), array( 14.68, 15 ), array( 12.09, 20 ),
array( 10, 25 ), array( 8.313, 30 ), array( 6.941, 35 ),
array( 5.828, 40 ),array( 4.912, 45 ), array( 4.161, 50 ),
array( 3.537, 55 ), array( 3.021, 60 ), array( 2.589, 65 ),
array( 2.229, 70 ), array( 1.924, 75 ), array( 1.669, 80 ),
array( 1.451, 85 ), array( 1.266, 90 ), array( 1.108, 95 ),
array( 0.9735, 100 ), array( 0.8574, 105 ), array( 0.7579, 110 ) );

//méthodes
public function calculRt(){
    return $this->Vadc * $this->Rdiv / ($this->Vcc - $this->Vadc);
}

public function calculTemperature(){

    $Rt = $this->calculRt();

    for($i = 0; $i < count($this->tblConvert)-1; $i++){

        $Rt1 = $this->tblConvert[$i][0];
        $T1  = $this->tblConvert[$i][1];

        $Rt2 = $this->tblConvert[$i+1][0];
        $T2  = $this->tblConvert[$i+1][1];

        if($Rt <= $Rt1 && $Rt >= $Rt2){

            // calcul de M
            $M = ($T2 - $T1) / ($Rt2 - $Rt1);

            // calcul de B
            $B = $T1 - $M * $Rt1;

            // température finale
            $Temp = $M * $Rt + $B;

            return $Temp;
        }
    }

    return "Valeur hors intervalle";
}

public function __construct(){
    $this->Vcc = 5;
    $this->Rdiv = 10;
    $this->Vadc = 2.5;
}

}
?>
