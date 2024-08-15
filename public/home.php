<?php
session_start();
include '../includes/db.php';
include '../includes/user_auth.php';

?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link type="text/css" rel="stylesheet" href="styles/styles.css">
     <title>Home Page</title>
     <style>


     #container{
      padding-bottom:30px;
     height: 100vh;
     background-color:#92A4D2;
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
        color:#FDD59A;
      }
      #picture{

        height:100vh;
        width:100%;
        margin:0;
        background-image:url(../images/1.jpg);
        background-repeat:no-repeat;
        background-position:center;
        background-size:cover;
      }



     </style>
   </head>
     <body>
  <div id="container">
    <div id="header">
      <h1 id="logo">School Webpage</h1>
    </div>
    <div id="nav-bar">
      <ul id="menu">
        <li><a href="/home" >Home</a><li>
        <li><a href="/viewcourses" >View Courses</a><li>
        <li><a href="/viewdepartment" >View Department</a><li>
        <li><a href="/userlogout">Logout</a><li>
      </ul>
    </div>
    <div id="picture" style="background-image:url(/images/2.jpg)">

    </div>



  </div>

   </body>
 </html>
