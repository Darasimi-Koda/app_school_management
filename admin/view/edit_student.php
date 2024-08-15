<?php
session_start();
// include '../includes/db.php';
include '../includes/admin_auth.php';


if(isset($_GET['id'])){
  $student_id = $_GET['id'];
}else{
  header("location:/editstudents");
  die();
}

$statement = $conn -> prepare("SELECT * FROM students");
$statement -> execute();

$select = array();
while($row = $statement -> fetch(PDO::FETCH_BOTH)){
  $select[] = $row;
}

$stmt = $conn -> prepare("SELECT * FROM students WHERE student_id=:sid");
$stmt -> bindParam(":sid",$student_id);
$stmt -> execute();

$record = $stmt -> fetch(PDO::FETCH_BOTH);
if($stmt -> rowCount() < 1){
  header("location:/editstudents");
  exit();
}

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['name'])){
  $error['name'] = "Enter Name";
}
if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
}
if(empty($_POST['class'])){
  $error['class'] = "Enter Class";
}
if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}

if(empty($error)){

$statement = $conn -> prepare("UPDATE students SET name=:nm,email=:em,class=:cs,hash=:hsh WHERE student_id=:sid");
$statement -> bindParam(":nm",$_POST['name']);
$statement -> bindParam(":em",$_POST['email']);
$statement -> bindParam(":cs",$_POST['class']);
$statement -> bindParam(":hsh",$_POST['hash']);
$statement -> bindParam(":sid",$student_id);

$statement -> execute();

header("location:/editstudents");
die();
}

}

 ?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Content</title>
    <style >
    #container{

      height:100vh;
      background-color:#5d3adf;
    }
    #header{
      background-color:black;

      height:12vh;
    }
    #logo{
    padding:20px;
      color:#b00002;
      text-align: center;
    }
    #input{
      margin-left:20px;
      padding-top:10px;

    }

    </style>
  </head>
  <body>
    <div id="container">
    <div id="header">
    <h1 id="logo">Edit Content</h1>
    </div>
    <div id="input">
    <form action="" method="post" style="color:#b00002">
      <p>Name:<input type="text" name="name" value="<?= $record['name']?>"/></p>
      <p>Email:<input type="email" name="email" value="<?= $record['email']?>"></p>
      <p>Password<input type="password" name="hash" value="<?= $record['hash']?>"></p>
    <select name="class" value="<?= $record['class']?>" style="color:#b00002">
      <option disabled selected>---Select Class of Your Choice----</option>
      <option value="JSS 1">JSS 1</option>
      <option value="JSS 2">JSS 2</option>
      <option value="JSS 3">JSS 3</option>
      <option value="SS 1">SS 1</option>
      <option value="SS 2">SS 2</option>
      <option value="SS 3">SS 3</option>
    </select>
      <p><input type="submit" name="submit" value="Update" style="color:#b00002"></p>
    </form>
    </div>
  </div>
  </body>
</html>
