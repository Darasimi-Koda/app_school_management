<?php
include '../includes/db.php';

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['name'])){
  $error['name'] = "Enter Name";
}
if(empty($_POST['user_name'])){
  $error['user_name'] = "Enter User Name";
}
if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
}else{
  $statement = $conn -> prepare("SELECT * FROM users WHERE email=:em");
  $statement -> bindParam(":em",$_POST['email']);
  $statement -> execute();
  if($statement -> rowCount() > 0){
    $error['email'] = "Email Already Exists";
  }
}
if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}
if(empty($_POST['confirm'])){
  $error['confirm'] = "Confirm Password";
}elseif($_POST['confirm'] !== $_POST['hash']){
  $error['confirm'] = "Password Mismatch";
}
if(empty($error)){

  $encrypted = password_hash($_POST['hash'],PASSWORD_BCRYPT);

  $stmt = $conn -> prepare("INSERT INTO users VALUES(NULL,:nm,:un,:em,:hsh,NOW(),NOW())");
  $data = array(
    ":nm" => $_POST['name'],
    ":un" => $_POST['user_name'],
    ":em" => $_POST['email'],
    ":hsh" => $encrypted
      );

  $stmt -> execute($data);
  header("location:/user_login?");
  exit();

}







}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Signup</title>
    <style >
    #container{

      height:100vh;
      background-color:#6b778f;
    }
    #header{

      height: 12vh;
      background-color:black;
    }
    #logo{
      padding:20px;
      color:#fef2dc;
      text-align: center;
      margin-right: 10px;


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
        <h1 id="logo">User Signup</h1>
      </div>



    <p></p>
    <p></p>
    <div id="input">
    <form action="" method="post" style="color:#2f5063">
      <?php
      if(isset($error['name'])){
        echo $error['name'];
      }
       ?>
      <p>Name:<input type="text" name="name" ></p>
      <?php
      if(isset($error['user_name'])){
        echo $error['user_name'];
      }
       ?>
      <p>User Name:<input type="text" name="user_name"></p>
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
      <?php
      if(isset($error['confirm'])){
        echo $error['confirm'];
      }
       ?>
      <p>Confirm Password:<input type="password" name="confirm"></p>
      <p><input type="submit" name="submit" value="Signup"></p>
    </form>
    </div>
  </div>
  </body>
</html>
