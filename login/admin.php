<?php
session_start();
if(empty($_SESSION['LoggedinAdmin']) || $_SESSION['LoggedinAdmin'] == ''){
    header("location:index.php?menu=login");
    die();
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<center>

<form method="post">

<h1>Admin page</h1>

<input type="submit" name="info" id="info" value="Show all users" style="width: 128px">

<input type="button" name="search" value="Search" style="width: 128px">

<input type="submit" name="cancel" id="cancel" value="Cancel/Back" style="width: 128px">

</form>

<?php
function showInfo(){
    include_once("db.php");
    $username = "root";
    $password = "";
    $key = "FZxTFEgS/BmVjzUNE+h7Ft76QidxjA78weXOtDFEueY=";
    $db = new Database("localhost","login_systemen",$username,$password,$key);
    $sth = $db->CreateQuery("SELECT * FROM `user`",$key);
    //$cards = $result->fetchall();
    
    if ($sth->rowCount() > 0) {
    // output data of each row
    echo "<table>";
    echo "<tr>";
    echo "<th>UserId</th>";
    echo "<th>Username</th>";
    echo "<th>Email</th>";
    echo "<th>Password</th>";
    echo "<th>Role</th>";
    echo "<th>Edit</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    while( $row = $sth->fetch(PDO::FETCH_ASSOC) ) {
        echo "<tr><td>" . $row["userid"]. "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["password"] . "</td><td>" . $row["role"]. "</td><td><a href='index.html?menu=edit?id=" . $row["userid"]. "'>Edit</a></td><td><a href='index.html?menu=delete?id=" . $row["userid"]. "'>Delete</a></td></tr>";
    }
        echo "</table>";
    } else { echo "0 results"; 
    }
}
if(array_key_exists('info',$_POST)){
    showInfo();
}
function logout(){
unset($_SESSION["Loggedin"]);
unset($_SESSION["LoggedinAdmin"]);
header("Location:index.php?menu=login");
}
if(array_key_exists('cancel',$_POST)){
    logout();
}
?>

</center>