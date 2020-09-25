<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<?php
session_start();
unset($_SESSION["Loggedin"]);
unset($_SESSION["LoggedinAdmin"]);
include_once("html.php");
$Name=$Email=$Pass="";

if(isset($_POST['Uitvoeren'])){
    $Name=$_POST['Name'];
    $Email=$_POST['Email'];
    $Pass=$_POST['Pass'];

    
        include_once("db.php");
        $username = "root";
        $password = "";
        $key = "FZxTFEgS/BmVjzUNE+h7Ft76QidxjA78weXOtDFEueY=";
        $db = new Database("localhost", "login_systemen", $username, $password,$key);

        $sql = "SELECT `email` FROM user WHERE Email = '".$Email."'";
        $result = $db->CreateQuery($sql,$key);
        if($result->rowCount() == 1){
            echo "<div class='alert alert-danger'>EMAIL IS AL BEZET!</div>";
        }else{
            $conn = $db->conn($key);
            $query = $conn->prepare("INSERT INTO user (Name, email, password) VALUES (?,?,?)");
            $data = array($Name,$Email,md5($Pass));
            $Check = $query->execute($data);

            if($Check){
                header("location:index.php?menu=login");
            }
            echo "<div class='alert alert-danger'>Er is iets foutgegaan moet het registreren</div>";
        
    }
}

Form::AddSetting("method", "POST");
Form::AddSetting("action", "");
Form::$legend = 'Registratieformulier';

Form::AddElement('text',$Name,'Name','Name','Name',true);
Form::AddElement('email',$Email,'test@test.test','Email','Email',true);
Form::AddElement('password',$Pass,'Password','Pass','Pass',true);

Form::AddElement('submit','Registreren','','Uitvoeren','btn btn-success');

Form::Show();

?>
<br />
