<?php
class Hand
{
  public $Kaarten = array();
  private $spelerAantal;
  function __construct($spelerAantal)
  {
    $this->spelerAantal = $spelerAantal;
  }
    public function AddToHand($kaart){
        array_push($this->Kaarten,$kaart);// Voeg kaart toe aan kaarten van hand
    }
    public function ShowHand($id){
        echo "<hand class='P" . $this->spelerAantal . "'>";
        foreach ($this->Kaarten as $key => $kaart) {
          echo "<kaart onclick='window.location.href=`index.php?Kaart=".$key."`;'>";
          if($this->spelerAantal==$id){$kaart->ShowKaart(true);}else{$kaart->ShowKaart();}
          echo "</kaart>";
         }
         
        echo "</hand>";
    }
    public function VerwijderVanHand($id){
      $kaart = $this->Kaarten[$id];// select kaart via $id
      unset($this->Kaarten[$id]);// verwijder de geselecteerde kaart van de hand
       $this->herschikHand();
      return $kaart;
      }
      private function herschikHand(){
       $nr=0;
       $tijdelijkDeck = $this->Kaarten;
       unset($this->Kaarten);// Maak de variable Kaarten leeg
       $this->Kaarten = array();
      foreach($tijdelijkDeck as $kaart){
        array_push($this->Kaarten,$kaart);//Vul de array Kaarten weer per kaart
       $nr++;
       }
      }
      public function PakRandomKaart(){
        $randomKaart = $this->VerwijderVanHand(rand(0, count($this->kaarten) - 1));
        return $randomKaart;
      }
}
