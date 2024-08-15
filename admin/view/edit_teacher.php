<?php
session_start();
// include '../includes/db.php';
include '../includes/admin_auth.php';


if(isset($_GET['id'])){
  $teacher_id = $_GET['id'];
}else{
  header("location:/editteachers");
  die();
}

$statement = $conn -> prepare("SELECT * FROM teachers");
$statement -> execute();

$select = array();
while($row = $statement -> fetch(PDO::FETCH_BOTH)){
  $select[] = $row;
}

$stmt = $conn -> prepare("SELECT * FROM teachers WHERE teacher_id=:tid");
$stmt -> bindParam(":tid",$teacher_id);
$stmt -> execute();

$record = $stmt -> fetch(PDO::FETCH_BOTH);
if($stmt -> rowCount() < 1){
  header("location:/editteachers");
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
if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}
if(empty($_POST['area_of_specialization'])){
  $error['area_of_specialization'] = "Select Area Of Specialization";
}

if(empty($error)){

$statement = $conn -> prepare("UPDATE teachers SET name=:nm,email=:em,hash=:hsh,area_of_specialization=:aos WHERE teacher_id=:tid");
$statement -> bindParam(":nm",$_POST['name']);
$statement -> bindParam(":em",$_POST['email']);
$statement -> bindParam(":hsh",$_POST['hash']);
$statement -> bindParam(":aos",$_POST['area_of_specialization']);
$statement -> bindParam(":tid",$teacher_id);

$statement -> execute();

header("location:/editteachers");
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

      margin-left: 20px;
      padding-top:10px;
    }
    </style>
  </head>
  <body>
    <div id="container">
      <div id="header">
    <h1 id="logo">Edit Content</h1>
      </div>
    <p></p>
    <p></p>
    <div id="input">
    <form action="" method="post" style="color:#49c3f4">
      <p>Name:<input type="text" name="name" value="<?= $record['name']?>"/></p>
      <p>Email:<input type="email" name="email" value="<?= $record['email']?>"></p>
      <p>Password<input type="password" name="hash" value="<?= $record['hash']?>"></p>
    <select name="area_of_specialization" value="<?= $record['area_of_specialization']?>" style="color:#49c3f4">
      <option disabled selected>----Area Of Specialization----</option>
      <option value="Teaching">Teaching</option>
      <option value="Non-Teaching">Non-Teaching</option>
    </select>
      <p><input type="submit" name="submit" value="Update" style="color:#49c3f4"></p>
    </form>
  </div>
  </div>
  </body>
</html>
