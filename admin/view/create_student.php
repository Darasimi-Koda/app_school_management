<?php
session_start();
// include '../includes/db.php';
include '../includes/admin_auth.php';

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
  $encrypted = password_hash($_POST['hash'],PASSWORD_BCRYPT);

  $statement = $conn -> prepare("INSERT INTO students VALUES(NULL,:nm,:em,:cs,:hsh,NOW(),NOW())");
  $statement -> bindParam(":nm",$_POST['name']);
  $statement -> bindParam(":em",$_POST['email']);
  $statement -> bindParam(":cs",$_POST['class']);
  $statement -> bindParam(":hsh",$encrypted);

  $statement -> execute();
  header("location:/editstudents");
  exit();
}

}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Student</title>
    <style >
    #container{
     padding-bottom:30px;
    height: 100vh;
    background-color:#334e5f;
    }

    #header{
      background-color:#150001;
    width:100%;
    height:15%;
    text-align:center;
     }
   #nav-bar{
     background-color:black;

     width:100%;
     height:7vh;

   }

   #menu{

     height:7vh;
     margin:0;
   }

   #menu li{

     display: inline-block;
   }

   #menu li a{

     color:white;
     text-decoration:none;
     display: inline-block;
     padding:11px;
     margin-left:30px;
       }

     #menu li a:hover{
       background-color:white;
       color:black;
     }

     #logo{

       padding-top:30px;
       margin-right:10px;
       color:#dedede;
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
    <h1 id="logo">Create Student</h1>
        </div>
    <div id="nav-bar">
      <ul id="menu">
    <li><a href="/dashboard" >Home</a></li>
    <li><a href="/teacher">Create Teacher</a></li>
    <li><a href="/student" >Create Student</a></li>
    <li><a href="/department">Add Department</a></li>
    <li><a href="/courses">Add Courses</a></li>
    <li><a href="/logout">Logout</a></li>
  </ul>
  </div>
  <div id="input">
    <form action="" method="post" style="color:#16263d">
      <?php
      if(isset($error['name'])){
        echo $error['name'];
      }
       ?>
      <p>Name:<input type="text" name="name" ></p>
      <p>Gender: Male<input type="checkbox"> Female<input type="checkbox"></p>
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
      if(isset($error['class'])){
        echo $error['class'];
      }
       ?>
      <select name="class" style="color:#16263d">
        <option disabled selected>---Select Class of Your Choice----</option>
        <option value="JSS 1">JSS 1</option>
        <option value="JSS 2">JSS 2</option>
        <option value="JSS 3">JSS 3</option>
        <option value="SS 1">SS 1</option>
        <option value="SS 2">SS 2</option>
        <option value="SS 3">SS 3</option>
      </select>
      <p><input type="submit" name="submit" value="Create" style="color:#16263d"/></p>
    </form>
  </div>
  </div>
  </body>
</html>
