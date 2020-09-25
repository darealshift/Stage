<?php
class Spelleider{
 public $Deck;
 public $Aflegstapel;
 public $SpelersAantal;
 public $Spelers;
 private $beurt;
 public $LR;
 function __construct($SpelersAantal){
//initialiseren van de fields
$this->SpelersAantal = $SpelersAantal;
 // aanmaken van het deck
 $this->Deck = new Deck();
 $this->Deck->Shuffle();
 // aanmaken van de aflegstapel
 $this->Aflegstapel = new Aflegstapel();
 // aanmaken van de spelers
 $this->spelermaken($this->SpelersAantal);
 // kaarten verdelen
$this->KaartenVerdelen($this->SpelersAantal);
 // Kaart van het deck rapen en op de aflegstapel plaatsen
 $kaart = $this->Deck->Rapen();
 $this->Aflegstapel->PlaatsKaart($kaart);
 // Random beginnende speler kiezen.
$this->beurt = rand(0, count($this->Spelers)-1);
 }

function spelermaken() {
    $this->Spelers = array();
    for ($i=0; $i < $this->SpelersAantal; $i++){
        $this->Spelers[$i] = new Hand($i);
    }
}

 function KaartenVerdelen($SpelersAantal) {
    $aantalKaarten = 7;
    for($I = 0; $I < $aantalKaarten; $I++){
        for($i=0; $i < $SpelersAantal; $i++){
            $kaart = $this->Deck->Rapen();
            $this->Spelers[$i]->AddToHand($kaart);  
        }
    }
 }

 
 function Show(){
for ($i=0; $i < count($this->Spelers); $i++) {
 $this->Spelers[$i]->ShowHand($this->beurt);
 }
 echo "<regel>";
 $this->Deck->ShowDeck();
 $this->Aflegstapel->ShowAflegstapel();
 echo "</regel>";
 }
 private function speelKaart($kaartid){
    function winnen(){
            
        }
        // controleer hier of de speler nog 1 kaart heeft
         // zo ja controleer of het een pestkaart is
         // zo ja pak 2 kaarten
        
        
    if($this->Spelers[$this->beurt]->Kaarten[$kaartid]->GetWaarde()==$this->Aflegstapel->Kaarten[count($this->Aflegstapel->Kaarten)-1]->GetWaarde()||$this->Spelers[$this->beurt]->Kaarten[$kaartid]->GetTeken()==$this->Aflegstapel->Kaarten[count($this->Aflegstapel->Kaarten)-1]->GetTeken()||($this->Spelers[$this->beurt]->Kaarten[$kaartid]->GetWaarde()=='J')||($this->Spelers[$this->beurt]->Kaarten[$kaartid]->GetWaarde()=='X')||($this->Spelers[$this->beurt]->Kaarten[$kaartid]->GetTeken()=='J')){
     $kaart = $this->Spelers[$this->beurt]->VerwijderVanHand($kaartid);
    switch ($kaart->GetWaarde()) {
        case '2':
            $this->volgendeSpeler();
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
        break;
        case '7':
        break;
        case '8':
            $this->volgendeSpeler();
            $this->volgendeSpeler();
        break;
        case '10':
           // willekeurige int van 0 tot aantal kaarten in de hand
           // willekeurige kaart van speler uit de hand nemen
           // volgende speler, en plaats de kaart in zijn hand
           
           for($j=0; $j < $this->SpelersAantal; $j++){
            $kaartx = $this->Spelers[$this->beurt]->Kaarten[rand(0, count($this->Spelers[$this->beurt]->Kaarten) - 1)];
            $this->volgendeSpeler();
            $this->Spelers[$this->beurt]->AddToHand($kaartx);
           }
        break;
        case 'K'://niks
        break;
        case 'A': //draai de richting (LR)
            $this->LR = !$this->LR;
            $this->volgendeSpeler();
        break;
        case 'X':
            $this->volgendeSpeler();
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
            $this->Aflegstapel->PlaatsKaart($kaart);
            $kaart = $this->Deck->Rapen();
        break;
    default: //Dit zijn geen pestkaarten
     $this->volgendeSpeler();
    break;
     }
     $this->Aflegstapel->PlaatsKaart($kaart);
     winnen();
     }
    }
    public function Klick($waarde){
        if($waarde=="pakken"){
            $this->Spelers[$this->beurt]->AddToHand($this->Deck->Rapen());
           if(count($this->Deck->Kaarten)<3){
            $kaarten = $this->Aflegstapel->GeefAlleKaarten();
           foreach ($kaarten as $kaart) {
           array_push($this->Deck->Kaarten,$kaart);
            }
            $this->Deck->Schudden();
            }
            $this->volgendeSpeler();
           }else{
            $this->speelKaart($waarde);
           }
        }
    private function volgendeSpeler(){
    if($this->LR){$this->beurt++;}else{$this->beurt--;}
    if($this->beurt==count($this->Spelers)){$this->beurt=0;}
    if($this->beurt==-1){$this->beurt=count($this->Spelers)-1;}
    }
    private function kaartPakken(){
        $kaart =  $this->Deck->Rapen();
        $this->Spelers[$this->beurt]->AddToHand($kaart);
        
        //Pak een kaart van de stapel en voeg de kaart toe aan de speler }
}
}
?>