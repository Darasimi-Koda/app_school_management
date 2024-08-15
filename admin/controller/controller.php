 <?php

 function fetchData($dbconn){
   $stmt = $dbconn -> prepare("SELECT * FROM admin");
   $stmt -> execute();
   while($row = $stmt -> fetch(PDO::FETCH_BOTH)){

   }


 }
