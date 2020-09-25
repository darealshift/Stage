<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<?php
session_start();
unset($_SESSION["Loggedin"]);
unset($_SESSION["LoggedinAdmin"]);
include_once("html.php");
$Email=$Pass="";
if(isset($_POST['login'])){
    $Email=$_POST['Email'];
    $Pass=$_POST['Pass'];

        include_once("db.php");
        $username = "root";
        $password = "";
        $key = "FZxTFEgS/BmVjzUNE+h7Ft76QidxjA78weXOtDFEueY=";
        $db = new Database("localhost", "login_systemen", $username, $password,$key);
        $sql = "SELECT email, password, role FROM user WHERE email = '".$Email."' and password = '".md5($Pass)."'";
        $result = $db->CreateQuery($sql,$key);
        $check = $result->fetch();
        $Check = $result->fetchall();
        if($result->rowCount() == 1){
            $sth = $db->CreateQuery("SELECT role FROM user WHERE email = '".$Email."'", $key);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            $role = implode($result);
            print_r($result);
            
            if ($role == 'admin') {
                header("location:index.php?menu=admin");
                $_SESSION['LoggedinAdmin'] = "LoggedinAdmin";
            }
            else {
               header("location:index.php?menu=user");
               $_SESSION['Loggedin'] = "Loggedin";
            }
            }
        }


if(isset($_POST['register'])){
    header("location:index.php?menu=register");
}

Form::AddSetting("method", "POST");
Form::AddSetting("action", "");
Form::$legend = 'Inloggen';

Form::AddElement('email',$Email,'test@test.test','Email','Email');
Form::AddElement('password',$Pass,'Wachtwoord','Pass','Pass');

Form::AddElement('submit','Inloggen','','login','btn btn-success');
Form::AddElement('submit','Registreren','','register','btn btn-info');

Form::Show();

?>
<br />