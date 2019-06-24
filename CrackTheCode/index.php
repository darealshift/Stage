<?php
class Wheel
{
    private $id;
    private $numbers;
    private $top;
    private $selected;
    private $bottom;
    function __construct($id,$array)
    {
        $this->id = $id;
        $this->numbers = $array;
        $this->top = 0;
        $this->selected = 1;
        $this->bottom = 2;
    }
    public function Up(){
        $this->top++;$this->selected++;$this->bottom++;
        if($this->top==count($this->numbers)){$this->top=0;}
        if($this->selected==count($this->numbers)){$this->selected=0;}
        if($this->bottom==count($this->numbers)){$this->bottom=0;}
    }
    public function Down(){
        $this->top--;$this->selected--;$this->bottom--;
        if($this->top==-1){$this->top=count($this->numbers)-1;}
        if($this->selected==-1){$this->selected=count($this->numbers)-1;}
        if($this->bottom==-1){$this->bottom=count($this->numbers)-1;}
    }
    public function Show(){
        echo
        "<Wheel>".
        "<Arrow class='up' onclick='window.location.href=`index.php?Lock=UP&Wheel=".$this->id."`;'></Arrow>".
        "<Number class='top'>".$this->numbers[$this->top]."</Number>".
        "<Number class='selected'>".$this->numbers[$this->selected]."</Number>".
        "<Number class='bottom'>".$this->numbers[$this->bottom]."</Number>".
        "<Arrow class='down' onclick='window.location.href=`index.php?Lock=DOWN&Wheel=".$this->id."`;'></Arrow>".
        "</Wheel>";
    }
    public function check(){return $this->numbers[$this->selected];}
}

class Lock
{
    public $Wheels;
    private $code;
    private $correct;
    private $hints;
    function __construct($amount)
    {
        $this->Wheels = array();
        $this->code = array();
        $this->hints = array();
        $numbers = array(0,1,2,3,4,5,6,7,8,9);

        for ($i=1; $i <= $amount; $i++) {
            $this->Wheels[$i] = new Wheel($i,$numbers);
            $this->code[$i] = $numbers[rand(0,count($numbers)-1)];
        }
        $this->correct="";
    }
    public function Show(){
        echo "<lock>";
        foreach ($this->Wheels as $Wheel => $wheel) {
            $wheel->Show();
        }
        echo "<Check ".$this->correct."onclick='window.location.href=`index.php?check=`;'>check</Check>";
        echo "</lock>";
        echo "<Code style='display:none;'>";
        foreach ($this->code as $nr) {
            echo $nr;
        }

        echo "</Code>";
        echo "<hints>";
        echo "<h2>Hints:</h2>";
        foreach ($this->hints as $hint) {
            echo $hint . "<br/>";
        }
        echo "</hints>";

    }
    public function Move($UpOrDown,$IdWheel){
        if($UpOrDown=='UP'){
        $this->Wheels[$IdWheel]->Up();
        }elseif($UpOrDown=='DOWN'){
        $this->Wheels[$IdWheel]->Down();
        }
    }
    public function Check(){
        $check = true;
        for ($i=1; $i <= count($this->Wheels); $i++) {
        if($this->Wheels[$i]->Check() != $this->code[$i]){$check = false;}
        }
             if($check){
                 $this->correct="class='correct'";
             }else{
                 $aantal = count($this->hints);
                 $this->hints[$aantal] = $this->givehint($aantal);
             }
    }
    private function givehint($nr){
        switch ($nr) {
            case 1:
                if($this->code[1]<$this->code[2]){
                    return "Het eerste cijfer is groter dan het tweede cijfer";
                }elseif($this->code[1]>$this->code[2]){
                    return "Het eerste cijfer is kleiner dan het tweede cijfer";
                }else{
                    return "Het eerste cijfer is gelijk aan het tweede cijfer";
                }
            break;
            case 2:
                $x = 0;
                foreach ($this->code as $nr) {
                    if($nr> $x){$x=$nr;}
                }
                return "Het hoogste getal is ".$x;
            break;
            case 3:
                $y = 0;
                foreach ($this->code as $nr) {
                    if($nr!=$y){$y=$nr;}
                }
                return "Het laatste getal is ".$y;
            break;
            case 4:
                $checkding = true;
                while($checkding){
                    $x = rand(0,9);
                    foreach ($this->code as $nr) {
                        if($x==$nr){$checkding=false;}
                    }
                    return "Het getal ".$x." komt niet voor";
                }
            break;
            default:
                return "probeer nog een keer!";
            break;
                        }

        if($this->code[0]<$this->code[1]){return "Het eerste cijfer is groter dan het tweede cijfer";}
        return "probeer nog een keer!";
    }
}

session_start();
if(isset($_SESSION['lock'])){$lock = $_SESSION['lock'];}else{$lock = new Lock(3);}
if(isset($_GET['reset'])){session_destroy();header("location:index.php");}
if(isset($_GET['Wheel'])){$lock->Move($_GET['Lock'],$_GET['Wheel']);}
if(isset($_GET['check'])){$lock->Check();}
?>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title>Crack The Code</title>
<style type="text/css">
    hints{float: left;position: absolute;right: 0px;background-color: #999;border: 3px solid black;padding 10px;}hints ul(top: 50px;)
      Lock,hints{display: block;}Check{margin-top: 315px;left:calc(86px * -3);}Next{top:2px;}P{bottom:0px;position:absolute;}
      Check,Next{height: 60px;background-color: #999;width: calc((86px * 3) - 6px);font-size: 50px;text-align: center;position:relative;}
      Wheel,Number,Check,Next{display: block;border: 3px solid black;float: left;}Wheel{width: 80px;background-color: black;text-align: center;height:306px;}
      Arrow{border: 3px solid chocolate;border-width: 0 3px 3px 0;padding: 25px;display: inline-block;position:relative;}
      Number{height:60px;font-size: 50px;position: relative;width: inherit;display: inline-block;border-left: 0px;border-right: 0px;}
      .selected{background-color: #999;border-color: chocolate;}.correct{background-color: green;}hints p{font-weight: bold;font-size: 30px;top: 0px;}
      .top{border-bottom: 0px;background-image: linear-gradient(black, #999);}.bottom{border-top:0px;background-image: linear-gradient(#999, black);}
      .up{top:13px;transform: rotate(-135deg);-webkit-transform: rotate(-135deg);}.down{bottom: 13px;transform: rotate(45deg);-webkit-transform: rotate(45deg);}
    </style>
</head>
<body>
    <?php
        $lock->Show();
        $_SESSION['lock'] = $lock;
    ?>
    <P><a href="index.php?reset=">Reset Game</a></P>
</body>
</html>
