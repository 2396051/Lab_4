<?php

class Thermistor
{
    // propriétés
    protected $Vcc;
    protected $Vadc;
    protected $Rt;
    protected $Rdiv;

    private $tblConvert = array(
        array(111.3, -30.0), array(86.39, -25), array(67.74, -20),
        array(53.39, -15), array(42.45, -10), array(33.89, -5),
        array(27.28, 0), array(22.05, 5), array(17.96, 10),
        array(14.68, 15), array(12.09, 20), array(10, 25),
        array(8.313, 30), array(6.941, 35), array(5.828, 40),
        array(4.912, 45), array(4.161, 50), array(3.537, 55),
        array(3.021, 60), array(2.589, 65), array(2.229, 70),
        array(1.924, 75), array(1.669, 80), array(1.451, 85),
        array(1.266, 90), array(1.108, 95), array(0.9735, 100),
        array(0.8574, 105), array(0.7579, 110)
    );

    // constructeur avec valeurs par défaut
    public function __construct()
    {
        $this->Vcc = 5;
        $this->Rdiv = 10;
        $this->Vadc = 2.5;
        $this->Rt = 0;
    }

    // setters
    public function setVcc($valeur)
    {
        if(is_numeric($valeur))
        $this->Vcc = $valeur;
    }

    public function setRdiv($valeur)
    {
        if(is_numeric($valeur))
        $this->Rdiv = $valeur;
    }

    public function setVadc($valeur)
    {
        if(is_numeric($valeur))
        $this->Vadc = $valeur;
    }

    public function calculRt()
    {
    if ($this->Vcc == $this->Vadc) {
        return 0;
    }

    $this->Rt = $this->Vadc * $this->Rdiv / ($this->Vcc - $this->Vadc);
    return $this->Rt;
    }

    public function calculTemperature($unite)
    {
    $Rt = $this->calculRt();

    // extrémités
    if ($Rt >= $this->tblConvert[0][0]) {
        return $this->tblConvert[0][1]; // -30°C
    }

    if ($Rt <= $this->tblConvert[count($this->tblConvert) - 1][0]) {
        return $this->tblConvert[count($this->tblConvert) - 1][1]; // 110°C
    }

    for ($i = 0; $i < count($this->tblConvert) - 1; $i++) {
        $Rt1 = $this->tblConvert[$i][0];
        $T1  = $this->tblConvert[$i][1];

        $Rt2 = $this->tblConvert[$i + 1][0];
        $T2  = $this->tblConvert[$i + 1][1];

        if ($Rt <= $Rt1 && $Rt >= $Rt2) {
            $M = ($T2 - $T1) / ($Rt2 - $Rt1);
            $B = $T1 - ($M * $Rt1);
            $Temp = $M * $Rt + $B;

            
            return $Temp;
        }
    }
    }
}
?>