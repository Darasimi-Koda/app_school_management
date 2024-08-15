<?php
// include '../includes/db.php';

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['name'])){
  $error['name'] = "Please Enter Name";
}
if(empty($_POST['user_name'])){
  $error['user_name'] = "Please Enter Username";
}
if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
}else{
$statement = $conn -> prepare("SELECT * FROM admin WHERE email=:em");
$statement	-> bindParam(":em",$_POST['email']);
$statement -> execute();
if($statement -> rowCount() > 0){
  $error['email'] = "Email Already Exists";
  }
}
if(empty($_POST['hash'])){
  $error['hash'] = "Please Enter Password";
}
if(empty($_POST['confirm'])){
  $error['confirm'] = "Confirm Password";
}elseif($_POST['confirm'] !== $_POST['hash']){
  $error['confirm'] = "Password Mismatch";
}

if(empty($error)){
  $encrypted = password_hash($_POST['hash'],PASSWORD_BCRYPT);

  $stmt = $conn -> prepare("INSERT INTO admin VALUES(NULL,:nm,:unm,:em,:hsh,NOW(),NOW())");
  $data = array(
    ":nm" => $_POST['name'],
    ":unm" => $_POST['user_name'],
    ":em" => $_POST['email'],
    ":hsh" => $encrypted
  );
  $stmt -> execute($data);

  header("location:/login?");
  exit();

}
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Signup</title>
    <style>
    #container{

      height: 100vh;
      background-color:#0f7a8e;
    }
    #header{

      height:10vh;
      background-color:black;
    }
    #logo{
      padding: 20px;
      color:#E1d1b7;
      text-align: center;
    }
    #input{
      margin-left:20px;
      padding-top: 10px;
    }
    </style>
  </head>
  <body >
    <div id="container">
      <div id="header">
          <h1 id="logo">Admin Signup</h1>

      </div>
    <p></p>
    <p></p>
    <div id="input">

<form action="" method="post">
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
    <p>User Name:<input type="text" name="user_name" ></p>
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
    <input type="submit" name="submit" value="Signup">
</form>

</div>
  </div>
  </body>
</html>
