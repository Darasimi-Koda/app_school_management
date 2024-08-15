<?php
session_start();
include '../includes/db.php';
include '../includes/user_auth.php';


$stmt = $conn -> prepare("SELECT * FROM department");
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
    <style >

    #container{

      height:auto;
      background-color:#45636d;

    }
    #header{
      background-color:#5bc3cc;
      height:12vh;
    }
    #nav-bar{
      background-color: black;
      height:7vh;
    }
    #menu{

      margin: 0;
    }
    #menu li{

      text-decoration: none;
      display: inline-block;
      padding:11px;
    }
    #menu li a{

      color: white;
      padding: 11px;
      margin-left:25px;
      text-decoration: none;
    }
    #menu li a:hover{
      color:black;
      background-color:white;
    }
    #logo{

      text-align: center;
      padding-top: 10px;
      margin-right: 10px;
      color:#f8faf9;
    }
    #table{

      width:100%;
      height:auto;


    }
    #head{

      font-size:20px;
      font-weight: bold;
      margin-left:200px;
      background-color:#c4f0f3;
      margin-left:100px;
      color:#26495d;
      width:40px;

      }
    #data{

      height:auto;
      width:100%;
      background-color:#bc6bd1;
      color:black;

    }
    #table_head{

      width:100%;

      height:auto;
    }
    #picture{
      height:100vh;
      width:100%;
      margin-top:30px ;

      background-repeat:no-repeat;
      background-position:center;
      background-size:cover;
    }

      </style>
    <title>View Department</title>
  </head>
  <body>
    <div id="container">
      <div id="header">
      <h1 id="logo">View Department</h1>
    </div>
    <div id="nav-bar">
      <ul id="menu">
        <li><a href="/home" >Home</a><li>
        <li><a href="/viewcourses" >View Courses</a><li>
        <li><a href="/viewdepartment" >View Department</a><li>
        <li><a href="/logout">Logout</a><li>
      </ul>
    </div>
    <p></p>
    <p></p>
    <div id="table">
      <h3 style="color:#f3a366">These Are The Departments Present in Our School:</h3>
    <table id="table_head">
      <tr id="head">
        <th>Department Name</th>
        <th>Department Head</th>
      </tr>
      <?php foreach ($records as $value):?>
        <tr id="data">
          <td><?= $value['department_name']?></td>
          <td><?= $value['department_head']?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    </div>
      <div id="picture" style="background-image:url(/images/4.jpg)">

      </div>

      </div>
  </body>
</html>
