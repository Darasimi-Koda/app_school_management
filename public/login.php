<?php
session_start();
include '../includes/db.php';

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
}
if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}

if(empty($error)){

$stmt = $conn -> prepare("SELECT * FROM users WHERE email=:em");
$stmt -> bindParam(":em",$_POST['email']);
$stmt -> execute();

$record = $stmt -> fetch(PDO::FETCH_BOTH);

if($stmt -> rowCount() > 0 && password_verify($_POST['hash'],$record['hash'])){
  $_SESSION['user_id'] = $record['user_id'];
  $_SESSION['user_name'] = $record['user_name'];

header("location:/home");
exit();

}else{
  header("location:/user_login?error= Either email or password is incorrect");
  exit();
    }
  }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Login</title>
    <style>
      #container{

        height:100vh;
        background-color:#93a0cd;
      }
      #header{
        background-color:black;

        height:12vh;
      }
      #logo{
      padding:20px;
        color:#e4670b;
        text-align: center;
      }
      #input{

        margin-left:30px;
        display: inline-block;


      }
    </style>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1 id="logo">User Login</h1>
      </div>

    <p></p>
    <p></p>
    <div id="input">


    <?php
    if(isset($_GET['error'])){
      echo $_GET['error'];
    }
     ?>
     <p></p>
    <form action="" method="post" style="color:#1c9eb8">
      <?php
      if(isset($error['email'])){
        echo $error['email'];
      }
       ?>
      <p>Email:<input type="email" name="email"></p>
      <?php
      if(isset($error['hash'])){
        echo $error['hash'];
      }
       ?>
      <p>Password:<input type="password" name="hash"></p>
      <p><input type="submit" name="submit" value="Login"></p>
    </form>
    </div>
  </div>
  </body>
</html>
