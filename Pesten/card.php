<?php
class Card
{
  private $teken;
  private $waarde;

  function __construct($teken, $waarde)
  {
    $this->teken = $teken;
    $this->waarde = $waarde;
  }

  public function GetWaarde(){return $this->waarde;}
  public function GetTeken(){return $this->teken;}

  function ShowKaart($Zichtbaar = false){
    if($Zichtbaar){
      echo "<img src='images/".$this->waarde.$this->teken.".png' />";
    }else{
      echo "<img src='images/GB.png' />";
    }
   }
}

?>