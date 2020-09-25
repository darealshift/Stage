<?php
class Aflegstapel{
 public $Kaarten;
 function __construct(){
// initialiseren van fields.
$this->Kaarten = array();
 }
 function PlaatsKaart($kaart){
     array_push($this->Kaarten, $kaart);
// leg de kaart boven op de stapel
 }
 function GeefAlleKaarten(){
 $alleKaarten = array(); // maak een lege array aan.
 //$totaal = count($this->Kaarten);
 $bovensteKaart = $this->Kaarten[$totaal -1];
 unset($this->Kaarten[$totaal -1]);
 foreach($this->Kaarten as $key => $Kaart){  
     array_push($alleKaarten, $Kaart);
 }
 $this->Kaarten = array();
 $this->PlaatsKaart($bovensteKaart);
 return $alleKaarten; 
//zet alle kaarten (behalve de bovenste kaart) in $alleKaarten.
//met een foreach loop
// unset de gekozen kaarten uit de public $Kaarten.
// geef $alleKaarten door.
 }
 function ShowAflegstapel(){
 echo "<aflegstapel>";
foreach($this->Kaarten as $kaart){
 echo "<kaart>";
 $kaart->ShowKaart(true);
 echo "</kaart>";
 }
 echo "</aflegstapel>";
 }
}
?>