<?php
if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])){
  header("location:/user_login?error= You are not logged in this page requires a login access");
 die();
}


 ?>
