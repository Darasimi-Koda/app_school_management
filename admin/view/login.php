<?php
session_start();
// include '../includes/db.php';

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
  }

if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}
if(empty($error)){

  $stmt = $conn -> prepare("SELECT * FROM admin WHERE email=:em");
  $stmt -> bindParam(":em",$_POST['email']);
  $stmt -> execute();

  $record = $stmt -> fetch(PDO::FETCH_BOTH);

if($stmt -> rowCount() > 0 && password_verify($_POST['hash'],$record['hash'])){
  $_SESSION['admin_id'] = $record['admin_id'];
  $_SESSION['admin_name'] = $record['admin_name'];

  header("location:/dashboard");
  exit();

}else{

  header("location:/login?error=Either Email or Password Incorrect");
    }
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>
<style>
#container{

  height: 100vh;
  background-color:#f5b3bd;
}
#header{

  height: 12vh;
  background-color:#201f2f;
}
#logo{

  text-align: center;
  padding:15px;
  color:#c4c5c9;

}
#input{
  margin-left:20px;
  padding-top:10px;
}
</style>
</head>

<body >
  <div id="container">
    <div id="header">
      <h1 id="logo">Admin Login</h1>

    </div>
<p></p>
<p></p>
<?php if(isset($_GET['error'])){
	echo $_GET['error'];
	}
?>
<div id="input">

<form action="" method="post">
<?php if(isset($error['email'])){
	echo $error['email'];
	}
?>
<p>Email:<input type="email" name="email"/></p>
<?php if(isset($error['hash'])){
	echo $error['hash'];
	}
?>
<p>Password:<input type="password" name="hash"/></p>

<input type="submit" name="submit" value="Login"/>
</form>

</div>
  </div>
</body>
</html>
