<?php
session_start();
// include '../includes/db.php';
include '../includes/admin_auth.php';

$stmt = $conn -> prepare("SELECT * FROM students");
$stmt -> execute();

$records = array();

while($row = $stmt -> fetch(PDO::FETCH_BOTH)){
  $records[] = $row;
}




 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Students</title>
    <style>
    #container{
     padding-bottom:30px;
    height: 100vh;
    background-color:#496771;
    }

    #header{
      background-color:#ce9a73;
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
       color:#fc993c;
     }
     #table{

       width:100%;
       height:auto;


     }
     #head{

       font-size:20px;
       font-weight: bold;
       margin-left:200px;
       background-color:#3d2012;
       margin-left:100px;
       color:#26495d;
       width:40px;

       }
     #data{

       height:auto;
       width:100%;
       background-color:#f7a993;
       color:black;

     }
     #table_head{

       width:100%;
       height:auto;
     }

    </style>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1 id="logo">Edit Students</h1>
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
  <div id="table">
     <table id="table_head">
     <tr id="head">
       <th>Student Name</th>
       <th>Email</th>
       <th>Edit</th>
       <th>Class</th>
       <th>Date Created</th>
       <th>Time Created</th>
     </tr>
     <?php foreach($records as $value):?>
       <tr id="data">
         <td><?= $value['name']?></td>
         <td><?= $value['email']?></td>
         <td><a href="/editstudent?id=<?= $value['student_id']?>" style='color:#423B9B'>Edit</a></td>
         <td><?= $value['class']?></td>
         <td><?= $value['date_created']?></td>
         <td><?= $value['time_created']?></td>
       </tr>
     <?php endforeach;?>
   </table>
 </div>
   </div>
  </body>
</html>
