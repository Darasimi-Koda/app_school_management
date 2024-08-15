<?php
session_start();
include '../includes/db.php';
include '../includes/user_auth.php';

$stmt = $conn -> prepare("SELECT * FROM courses");
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
    <style>

    #container{

      height:auto;
      background-color:#FE9f9d;
    }
    #header{
      background-color:#110004;
      height:15vh;
    }
    #nav-bar{
      background-color:black;

      height:7vh;
    }
    #menu{

      display:inline-block;
      margin: 0;
    }
    #menu li{

      display: inline-block;
    }
    #menu li a{

      color:white;
      text-decoration: none;
      display: inline-block;
      padding: 10px;
      margin-left:30px;
    }
    #menu li a:hover{
      color:black;
      background-color:white;
    }
    #logo{

      padding-top:20px;
      text-align: center;
      margin-right:20px;
      color:#2444BF;
    }
    #table{

      width:100%;
      height:auto;


    }
    #head{

      font-size:20px;
      font-weight: bold;
      margin-left:200px;
      background-color:black;
      margin-left:100px;
      color:#ff4d4a;
      width:40px;

      }
    #data{

      height:auto;
      width:100%;
      background-color:#be0000;
      color:white;

    }
    #table_head{

      width:100%;
      height:auto;
    }
    #picture{
      height:100vh;
      width:100%;
      margin-top:30px ;
      background-image:url(3.jpg);
      background-repeat:no-repeat;
      background-position:center;
      background-size:cover;
    }
    }

    </style>
    <title>View Courses</title>
  </head>
  <body >
<div id="container">
  <div id="header">
    <h1 id="logo">View Courses</h1>
</div>
  <div id="nav-bar">
    <ul id="menu">
      <li><a href="/home" >Home</a><li>
      <li>
        <a href="/viewcourses" >View Courses</a><li>
      <li><a href="/viewdepartment" >View Department</a><li>
      <li><a href="/userlogout">Logout</a><li>
    </ul>
  </div>


  <p></p>
  <div id="table">
    <h3 style="color:#82786e">These Are The Courses Which We Offer Listed Below:</h3>
    <table  id="table_head">

      <tr id="head">
        <th>Course Name</th>
        <th>Course Head</th>
        <th>Course Type</th>
      </tr>
      <?php foreach($records as $value):?>
        <tr id="data">
          <td ><?= $value['course_name']?></td>
          <td><?= $value['course_head']?></td>
          <td><?= $value['course_type']?></td>

        </tr>
      <?php endforeach; ?>

    </table>
    </div>


    <div id="picture" style="background-image:url(/images/3.jpg)">

    </div>

</div>
  </body>
</html>
