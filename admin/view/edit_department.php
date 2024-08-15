<?php
session_start();
// include '../includes/db.php';
include '../includes/admin_auth.php';


if(isset($_GET['id'])){
  $department_id = $_GET['id'];
}else{
  header("location:edit_department.php");
  die();
}

$statement = $conn -> prepare("SELECT * FROM department");
$statement -> execute();

$select = array();
while($row = $statement -> fetch(PDO::FETCH_BOTH)){
  $select[] = $row;
}

$stmt = $conn -> prepare("SELECT * FROM department WHERE department_id=:did");
$stmt -> bindParam(":did",$department_id);
$stmt -> execute();

$record = $stmt -> fetch(PDO::FETCH_BOTH);
if($stmt -> rowCount() < 1){
  header("location:/editdepartment");
  exit();
}

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['name'])){
  $error['name'] = "Enter Department Name";
}
if(empty($_POST['dept_name'])){
  $error['dept_name'] = "Enter Department Head";
}
if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
}
if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}

if(empty($error)){

$statement = $conn -> prepare("UPDATE department SET department_name=:dn,department_head=:dh,email=:em,hash=:hsh  WHERE department_id=:did");
$statement -> bindParam(":dn",$_POST['name']);
$statement -> bindParam(":dh",$_POST['dept_name']);
$statement -> bindParam(":em",$_POST['email']);
$statement -> bindParam(":hsh",$_POST['hash']);
$statement -> bindParam(":did",$department_id);

$statement -> execute();

header("location:/editdepartments");
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
      background-color:#33243b;
    }
    #header{
      background-color:black;

      height:12vh;
    }
    #logo{
    padding:20px;
      color:#f9499c;
      text-align: center;
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
    <h1 id="logo">Edit Content</h1>
      </div>
    <p></p>
    <p></p>
    <div id="input">
    <form action="" method="post" style="color:#f7f270">
      <p>Department Name:<input type="text" name="name" value="<?= $record['department_name']?>"></p>
      <p>Department Head:<input type="text" name="dept_name" value="<?= $record['department_head']?>"></p>
      <p>Email:<input type="email" name="email" value="<?= $record['email']?>"></p>
      <p>Password:<input type="password" name="hash" value="<?= $record['hash']?>"></p>
      <p><input type="submit" name="submit" value="Update" style="color:#f7f270"></p>
    </form>
    </div>
  </div>
  </body>
</html>
