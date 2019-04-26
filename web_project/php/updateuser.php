<?php
class MyDB extends SQLite3 {
   function __construct() {
      $this->open('..\db.sqlite3');
   }
}


if (isset($_POST['first']) && isset($_POST['last']) )
 {

$first=$_POST["first"];
$last=$_POST["last"];



$db = new MyDB();

    $query = $db->exec( ' UPDATE auth_user SET first_name="'.$first.'",last_name = "'.$last.'" WHERE username="'.$_POST["username"].'"' );
}


header("Location: http://127.0.0.1:8000/blogs/home/");
die();


?>
