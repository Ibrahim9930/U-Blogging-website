<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   header("Refresh:0; url=index.php");
?>
