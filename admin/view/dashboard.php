<?php
session_start();
include '../includes/admin_auth.php';
// include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <style>
    #container{
     padding-bottom:30px;
    height: 100vh;
    background-color:#4217af;
    }

    #header{

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
       color:#f7f1db;
     }
     #picture{
       height:100vh;
       width:100%;
       margin:0;
       background-image:url(../public/5.jpg);
       background-repeat:no-repeat;
       background-position:center;
       background-size:cover;


     }
    </style>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1 id="logo">Admin Dashboard</h1>
  </div>
    <div id="nav-bar">
      <ul id="menu">
    <li><a href="/dashboard">Home</a></li>
    <li><a href="/teacher">Create Teacher</a></li>
    <li><a href="/student" >Create Student</a></li>
    <li><a href="/department">Add Department</a></li>
    <li><a href="/courses">Add Courses</a></li>
    <li><a href="/logout">Logout</a></li>
  </ul>
  </div>
  <?php fetchData($conn); ?>
  <div id="picture" style="background-image:url(/images/6.jpg)">

  </div>
  </div>
  </body>
</html>
