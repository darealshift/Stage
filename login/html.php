<?php

class Header
{
    private static $title;
    private static $metas = array();
    private static $links = array();
    private static $scripts = array();

    public static function AddTitle($name) {self::$title=$name;}
    public static function AddMeta($description, $content) {
        array_push(self::$metas,"<meta name='".$description."' content='".$content."'>");
    }
    public static function AddLink($link, $rel) {
        array_push(self::$links,"<link href='".$link."' rel='".$rel."'>");
    }
    public static function AddScripts($link) {
        array_push(self::$scripts,"<script src='".$link."'></script>");
    }

    public static function Show() {
      echo "<head>";
        echo "<meta charset='utf-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>";
        echo "<title>".self::$title."</title>";
        foreach (self::$metas as $meta) {echo $meta;}
        foreach (self::$links as $link) {echo $link;}
        foreach (self::$scripts as $script) {echo $script;}
        echo "</head>";
    }
}

?>

<?php

class Form
{
  private static $FORM="";
  private static $settings=array();
  private static $selection = array();
  public static $legend="";
  public static function AddSetting($setting,$value){self::$settings[$setting] = $value;}
  public static function AddElement($type,$value,$placeholder,$name,$id,$required=false,$br=false){
    switch ($type) {
      case 'label':
        self::$FORM.="<label>".$value."</label>";
      break;
      case 'text':case 'password':case 'email':case 'textarea':case 'number':case 'tel':
        self::$FORM.="<input class='form-control' type='".$type."' value='".$value."' placeholder='".$placeholder."' name='".$name."' id='".$id."'";
        if($required){self::$FORM.=" required ";}
        self::$FORM.=" />";
      break;
      case 'submit':
        self::$FORM.="<input type='".$type."' value='".$value."' name='".$name."' class='".$id."'/>";
      break;
    }
    if($br){self::$FORM.="<br/>";}
  }
  public static function AddOption($value,$placeholder,$selected=true){
    $option = "<option value='".$value."' ";
    if($selected){$option .= "selected ";}
    $option .= ">".$placeholder."</option>";
    array_push(self::$selection,$option);
  }
  public static function AddSelection($name,$id){
    self::$FORM.="<select name='".$name."' id='".$id."'>";
    foreach (self::$selection as $option) {self::$FORM.=$option;}
    self::$FORM.="</select>";
    self::$FORM.="<br/>";
  }
  public static function AddGroupe(){self::$FORM.="</div><div class='form-group'>";}
  
  public static function Show(){
    echo "<div class='col-md-8 offset-md-2'>";
    echo "<form ";
    foreach (self::$settings as $setting => $value) {
      echo $setting."=".$value." ";
    }
    echo ">";
    echo "<fieldset>";
    echo '<div class="form-group">';
    if(self::$legend!=""){echo "<h3> <legend class='col-form-label'>".self::$legend."</legend> </h3>";}
    echo self::$FORM;
    echo "</div>";
    echo "</fieldset>";
    echo "</form>";
    echo "</div>";
  }
}
