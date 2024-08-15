<?php
// echo $_SERVER['REQUEST_URI'];
// var_dump($_SERVER);
// die();
// session_start();
// $application_name = "Darasimi Web";
// dirname(dirname(__FILE__));
//
 define("APP_PATH",dirname(dirname(__FILE__)));
 // Add Database Connection
 include APP_PATH."/admin/model/model.php";
 include APP_PATH."/admin/controller/controller.php";
 include APP_PATH."/admin/routes/router.php";


 ?>
