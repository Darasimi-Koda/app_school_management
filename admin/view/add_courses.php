<?php
session_start();
include '../includes/db.php';
include '../includes/admin_auth.php';

if(isset($_POST['submit'])){
  $error = array();

if(empty($_POST['name'])){
  $error['name'] = "Enter Course Name";
}
if(empty($_POST['course_name'])){
  $error['course_name'] = "Enter Course Head";
}
if(empty($_POST['course_type'])){
  $error['course_type'] = "Enter Course Type";
}
if(empty($_POST['email'])){
  $error['email'] = "Enter Email";
}

if(empty($_POST['hash'])){
  $error['hash'] = "Enter Password";
}
if(empty($error)){
  $encrypted = password_hash($_POST['hash'],PASSWORD_BCRYPT);

  $statement = $conn -> prepare("INSERT INTO courses VALUES(NULL,:cn,:ch,:ct,:em,:hsh,NOW(),NOW())");
  $statement -> bindParam(":cn",$_POST['name']);
  $statement -> bindParam(":ch",$_POST['course_name']);
  $statement -> bindParam(":ct",$_POST['course_type']);
  $statement -> bindParam(":em",$_POST['email']);
  $statement -> bindParam(":hsh",$encrypted);

  $statement -> execute();
  header("location:/editcourses");
  exit();
}

}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Courses</title>
    <style>
  #container{
  padding-bottom:30px;
   height: 100vh;
   background-color:#196b80;
   }

   #header{
   background-color:#100f0b;
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
      margin-left: 20px;
      padding-top: 10px;

    }

    </style>
  </head>
  <body>
    <div id="container">
    <div id="header">
      <h1 id="logo">Add Courses</h1>
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
    <p></p>
    <p></p>
    <div id="input">
    <form action="" method="post" >
      <?php
      if(isset($error['name'])){
        echo $error['name'];
      }
       ?>
      <p>Course Name:<input type="text" name="name"></p>
      <?php
      if(isset($error['course_name'])){
        echo $error['course_name'];
      }
       ?>
      <p>Course Head:<input type="text" name="course_name"></p>
      <?php
      if(isset($error['course_type'])){
        echo $error['course_type'];
      }
       ?>
       <p></p>
      <select name='course_type'>
        <option disabled selected>---Select Course Type---</option>
        <option value="Medicine">Medicine</option>
        <option value="Law">Law</option>
        <option value="Engineering">Engineering</option>
        <option value="Nursing">Nursing</option>
      </select>
      <p></p>
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
      <p><input type="submit" name="submit" value="Add"></p>
    </form>
    </div>
      </div>
  </body>
</html>
