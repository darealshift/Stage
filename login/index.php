<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<?php
include_once("html.php");
Header::AddTitle("Login Systeem");
Header::AddMeta("author", "Wesley Willemssen");
Header::AddLink("bootstrap/css/bootstrap.min.css", "stylesheet");
Header::AddLink("css/stylesheet.css", "stylesheet");

$menu="home";
if(isset($_GET['menu'])){$menu=$_GET['menu'];}

?>
<html lang="nl">
<?php Header::Show(); ?>
<body>
  <?php 
    switch ($menu) {
      case 'edit':
        include_once("edit.php");
      break;
      case 'delete':
        include_once("delete.php");
      break;
      case 'login':
        include_once("login.php");
      break;
      case 'register':
        include_once("register.php");
      break;
      case 'user':
        include_once("user.php");
      break;
      case 'admin':
        include_once("admin.php");
      break;
      case 'home':
      default:
        include_once("index.php");
      break;
    }

  ?>
<!-- <center>

<h1>Login</h1>

<form method="post">

Username: <input type="text" name="username" value=""><br/>

Password: <input type="text" name="password" value="" style="margin-left: 5px"><br/>

<input type="submit" name="login" value="Login" style="width: 128px">

<input type="button" name="register" value="Register" style="width: 128px" onClick="document.location.href='register.php'">

</form>

</center> -->
