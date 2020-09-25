<?php
/**
 *
 */
class Deck
{
  public $Kaarten;
  private $waarde;
  private $teken;
  function __construct()
  {
  $this->Kaarten = array();
  $this->CreateDeck();
  }
  private function CreateDeck(){
    $this->waarde = array("2","3","4","5","6","7","8","9","10","J","Q","K","A");
    $this->teken = array("H","K","R","S");
    $nr = 0;
    for ($i=0; $i < count($this->teken); $i++) {
      for ($j=0; $j < count($this->waarde); $j++) {
        $this->Kaarten[$nr] = new Card($this->teken[$i], $this->waarde[$j]);
        $nr++;
      }
    }
    $this->Kaarten[$nr] = new Card('J','X');
    $this->Kaarten[$nr] = new Card('J','X');
  }
  public function ShowDeck(){
    echo "<deck onclick='window.location.href=`index.php?Kaart=pakken`;'>";
    foreach ($this->Kaarten as $kaart) {
      echo "<kaart>";
      $kaart->ShowKaart();
      echo "</kaart>";
      echo "<br>";
    }
    echo "</deck>";
  }
  public function Rapen(){
    $totaal = count($this->Kaarten);
    $bovensteKaart = $this->Kaarten[$totaal -1];
    unset($this->Kaarten[$totaal -1]);
    return $bovensteKaart;
  }
  public function Shuffle(){
    shuffle($this->Kaarten);
    shuffle($this->Kaarten);
    }
}
?>
