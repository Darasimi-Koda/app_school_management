<?php
session_start();
// include '../includes/db.php';
include '../includes/admin_auth.php';

if(isset($_GET['id'])){
  $course_id = $_GET['id'];
}else{
  header("location:/editcourse");
  die();
}

$statement = $conn -> prepare("SELECT * FROM courses");
$statement -> execute();

$select = array();
while($row = $statement -> fetch(PDO::FETCH_BOTH)){
  $select[] = $row;
}

$stmt = $conn -> prepare("SELECT * FROM courses WHERE course_id=:cid");
$stmt -> bindParam(":cid",$course_id);
$stmt -> execute();

$record = $stmt -> fetch(PDO::FETCH_BOTH);
if($stmt -> rowCount() < 1){
  header("location:editcourse");
  exit();
}

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['name'])){
  $error['name'] = "Enter Course Name";
}
if(empty($_POST['course_name'])){
  $error['course_name'] = "Enter Course Head";
}
if(empty($_POST['course_type'])){
  $error['course_type'] = "Select Course Type";
}
if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
}
if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}

if(empty($error)){

$statement = $conn -> prepare("UPDATE courses SET course_name=:cn,course_head=:ch,course_type=:ct,email=:em,hash=:hsh WHERE course_id=:cid");
$statement -> bindParam(":cn",$_POST['name']);
$statement -> bindParam(":ch",$_POST['course_name']);
$statement -> bindParam(":ct",$_POST['course_type']);
$statement -> bindParam(":em",$_POST['email']);
$statement -> bindParam(":hsh",$_POST['hash']);
$statement -> bindParam(":cid",$course_id);

$statement -> execute();

header("location:/editcourses");
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
      background-color:#e5b3ac;
    }
    #header{
      background-color:black;

      height:12vh;
    }
    #logo{
    padding:20px;
      color:#fbf9ed;
      text-align: center;
    }
    #input{
      margin-left: 20px;
      padding-top: 10px;
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
      <form action="" method="post" style="color:#74aac4">
      <p>Course Name:<input type="text" name="name" value="<?= $record['course_name']?>" ></p>
      <p>Course Head:<input type="text" name="course_name" value="<?= $record['course_head']?>"></p>
        <select name='course_type' value="<?= $record['course_type']?>" style="color:#74aac4">
          <option disabled selected>---Select Course Type---</option>
          <option value="Medicine">Medicine</option>
          <option value="Law">Law</option>
          <option value="Engineering">Engineering</option>
          <option value="Nursing">Nursing</option>
        </select>
      <p>Email:<input type="email" name="email" value="<?= $record['email']?>"></p>
      <p>Password:<input type="password" name="hash" value="<?= $record['hash']?>"></p>
      <p><input type="submit" name="submit" value="Update" style="color:#74aac4"></p>
      </form>
      </div>
    </div>
  </body>
</html>
