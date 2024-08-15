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
if(empty($_POST['area_of_specialization'])){
  $error['area_of_specialization'] = "Select Area Of Specialization";
}
if(empty($error)){
$encrypted = password_hash($_POST['hash'],PASSWORD_BCRYPT);


  $stmt = $conn -> prepare("INSERT INTO teachers VALUES(NULL,:nm,:em,:aos,:hsh,NOW(),NOW())");
  $stmt ->bindParam(":nm",$_POST['name']);
  $stmt ->bindParam(":em",$_POST['email']);
  $stmt ->bindParam(":aos",$_POST['area_of_specialization']);
  $stmt ->bindParam(":hsh",$encrypted);


  $stmt -> execute();

  header("location:/editteachers");
  exit();
}
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Teacher</title>
    <style >
    #container{
     padding-bottom:30px;
    height: 100vh;
    background-color:#2a2e39;
    }

    #header{
      background-color:#d1653e;
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
       color:#e9e8ee;
     }
     #input{
       margin-left:20px;
       padding-top: 10px;
     }
    </style>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1 id="logo">Create Teacher</h1>
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
    <div id="input">
<form action="" method="post" style="color:#fdcd8d">
<?php
  if(isset($error['name'])){
    echo $error['name'];
  }

 ?>
<p>Name:<input type="text" name="name"></p>
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
  if(isset($error['area_of_specialization'])){
    echo $error['area_of_specialization'];
  }

 ?>
<select name="area_of_specialization" style="color:#fdcd8d">
  <option disabled selected>----Area Of Specialization----</option>
  <option value="Teaching">Teaching</option>
  <option value="Non-Teaching">Non-Teaching</option>
</select>

<p><input type="submit" name="submit" value="Create" style="color:#fdcd8d"></p>
</form>
  </div>
</div>

  </body>
</html>
