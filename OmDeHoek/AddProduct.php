<?php
$Product_ID=$Category=$IMG=$Img_Alt=$Title=$Price=$Description=$Rating="";
Form::$legend='Nieuw product';
include_once("db.php");
$username = "root";
$password = "";
$key = "FZxTFEgS/BmVjzUNE+h7Ft76QidxjA78weXOtDFEueY=";
$db = new Database("localhost", "omdehoekk", $username, $password,$key);
if(isset($_GET['ID']))
{
  $test = $db->CreateQuery("SELECT `idProduct`, `Category`, `IMG`,`Img_Alt`,`Title`,`Price`,`Description`,`Rating` FROM `product` WHERE `idProduct` = ".$_GET['ID'], $key);
  $conn = $db->conn($key);
  $result = $test->fetchall();
  
  $Product_ID = $result[0]['idProduct'];
  $Category = $result[0]['Category'];
  $IMG = $result[0]['IMG'];
  $Img_Alt = $result[0]['Img_Alt'];
  $Title = $result[0]['Title'];
  $Price = $result[0]['Price'];
  $Description = $result[0]['Description'];
  $Rating = $result[0]['Rating'];
}
if(isset($_POST['submit']))
{
  $conn = $db->conn($key);

  //$Product_link = mysql_real_escape_string($_POST['idProduct']);
  $Category = $_POST['Category'];
  $IMG = $_POST['IMG'];
  $Img_Alt = $_POST['Img_Alt'];
  $Title = $_POST['Title'];
  $Price = $_POST['Price'];
  $Description = $_POST['Description'];
  $Rating = $_POST['Rating'];
  //$Add_link = mysql_real_escape_string($_POST['a']);;

  if(isset($_GET['ID']) && $_GET['ID']==$Product_ID){
    $sql = $conn->prepare("UPDATE product SET Category=?, IMG=?,Img_Alt=?,Title=?,Price=?,Description=?,Rating=? WHERE idProduct = ?");
  }
  else
  {
    $sql = $conn->prepare("INSERT INTO product (Category, IMG,Img_Alt,Title,Price,Description,Rating) VALUES (?,?,?,?,?,?,?)");
  }
  //$sql->bind_param("sssdsi",$IMG,$Img_Alt,$Title,$Price,$Description,$Rating);
  $data = array($Category,$IMG,$Img_Alt,$Title,$Price,$Description,$Rating,$Product_ID);
  $sql->execute($data);
  Form::$legend='Nieuw product toegevoegd!';
}


Form::AddElement('label', 'Category', '', '', '');
// Form::AddOption($value,$placeholder,$selected=true)
$test = $db->CreateQuery("SELECT * FROM category", $key);
$result = $test->fetchAll();
foreach ($result as $option){
    $select = ($option['ID']==$Category)? true:false;
    Form::AddOption($option['ID'],$option['name'], $select);
}
Form::AddSelection('Category','Category');
Form::AddElement('label', 'IMG', '', '', '');
Form::AddElement('text', $IMG, 'path voor plaatje', 'IMG', 'IMG', true);
Form::AddElement('label', 'Img_Alt', '', '', '');
Form::AddElement('text', $Img_Alt, 'alt voor plaatje', 'Img_Alt', 'Img_Alt', true);
Form::AddGroupe();
Form::AddElement('label', 'Title', '', '', '');
Form::AddElement('text', $Title, 'Productnaam', 'Title', 'Title', true);
Form::AddElement('label', 'Price', '', '', '');
Form::AddElement('number', $Price."' step='0.01", '0.00', 'Price', 'Price', true);
Form::AddElement('label', 'Description', '', '', '');
Form::AddElement('textarea', $Description, '', 'Description', 'Description', true);
Form::AddElement('label', 'Rating', '', '', '');
Form::AddElement('number', $Rating, '1-5', 'Rating', 'Rating', true);
Form::AddElement('submit', 'Toevoegen', '', 'submit', 'btn btn-success');
Form::AddSetting('Method', 'POST');
Form::AddSetting('action', '');
Form::Show();
?>
