<?php
include_once('card.php');
include_once("deck.php");
include_once('hand.php');
include_once("spelleider.php");
include_once("aflegstapel.php");

    session_start();
    $aantalSpelers = 4;
    if(isset($_SESSION['Game'])){$Game = $_SESSION['Game'];}else{$Game = new Spelleider($aantalSpelers);}
    if(isset($_GET['Kaart'])){$Game->Klick($_GET['Kaart']);}
    if(isset($_GET['reset'])) {session_destroy();header("location:index.php");}

    $D = count($Game->Deck->Kaarten);if($D>21){$D=21;}
    $A = count($Game->Aflegstapel->Kaarten);if($A>21){$A=21;}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pesten</title>
    <style type="text/css">
    a{
        color: white;
        font-family: Arial;
        font-size: 16px;
        text-decoration: none;
    }
body{background-color:green;}
kaart img{height:154px;}hand{width:300px;height:200px;display:block;position:absolute;}
hand kaart{display:block;position:inherit;bottom:0px;}hand kaart:hover{top:0px;}
deck,aflegstapel{width:125px;left:250px;height:175px;float:left;display:block;}
deck kaart{left:<?php echo $D;?>px;bottom:<?php echo $D;?>px;position:absolute;}
aflegstapel kaart{left:<?php echo $A+125;?>px;bottom:<?php echo $A;?>px;position:absolute;}
<?php for($d=$D;$d>0;$d--){?>deck kaart:nth-child(<?php echo $d;?>)
{left:<?php echo $d;?>px;bottom:<?php echo $d;?>px;}<?php }?>
<?php for($a=$A;$a>0;$a--){?>aflegstapel kaart:nth-child(<?php echo $a;?>)
{left:<?php echo $a+125;?>px;bottom:<?php echo $a;?>px;}<?php }?>
.P0{left:250px;bottom:20px;} .P1{transform:rotate(90deg);left:0px;top:250px;}
.P2{transform: rotate(180deg);left: 250px;top:20px;} .P3{transform: rotate(-
90deg);right:0px;top:250px;} regel{width: 250px;left:250px;top: 250px;position: absolute;}
<?php for ($s=0; $s < $aantalSpelers; $s++)
{$kaartaantal = count($Game->Spelers[$s]->Kaarten);
if($kaartaantal>15){$graden=150;}else{$graden=80;}for ($k=1; $k <= $kaartaantal; $k++) {
echo ".P".$s." kaart:nth-child(".$k."){transform: rotate(".((($graden/$kaartaantal)*$k)-
($graden/2))."deg);left:".(50+(($graden/$kaartaantal)*$k))."px;}";}}?>
 </style>
</head>
<body>
<a href="index.php?reset=">Reset</a>
    <?php 
    $Game->Show();
    $_SESSION['Game'] = $Game;
    ?>
</body>
</html>