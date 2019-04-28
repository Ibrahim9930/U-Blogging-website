<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\..\db.sqlite3');
   }
}

if(isset($_POST['id']))
{
    $db = new MyDB();
    $query = $db->exec( ' UPDATE auth_user SET is_active=0 WHERE username="'.$_POST["id"].'"' );

    header("Refresh:0; url=index.php");

}

 ?>
