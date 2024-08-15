<?php
session_start();
// include '../includes/db.php';
include '../includes/admin_auth.php';

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
  $encrypted = password_hash($_POST['hash'],PASSWORD_BCRYPT);

  $statement = $conn -> prepare("INSERT into department VALUES(NULL,:dn,:dh,:em,:hsh,NOW(),NOW())");
  $data = array(
    ":dn" => $_POST['name'],
    ":dh" => $_POST['dept_name'],
    ":em" => $_POST['email'],
    ":hsh" => $encrypted
  );

  $statement -> execute($data);
  header("location:/editdepartments");
  exit();
}
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Department</title>
    <style>
    #container{
     padding-bottom:30px;
    height: 100vh;
    background-color:#a74a5f;
    }

    #header{
      background-color:#16293a;
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
    <h1 id="logo">Add Department</h1>
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
    <form action="" method="post" style="color:#e6505b">
      <?php
      if(isset($error['name'])){
        echo $error['name'];
      }
       ?>
      <p>Department Name:<input type="text" name="name"></p>
      <?php
      if(isset($error['dept_name'])){
        echo $error['dept_name'];
      }
       ?>
      <p>Department Head:<input type="text" name="dept_name"></p>
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

      <p><input type="submit" name="submit" value="Add" style="color:#e6505b"></p>

    </form>
    </div>
</div>
  </body>
</html>
