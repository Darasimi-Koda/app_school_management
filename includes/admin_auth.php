<?php

if(!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_name'])){
	header("location:/login?error=Login is needed to access admin page");
die();
}
