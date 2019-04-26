<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\..\db.sqlite3');
   }
}

if(isset($_POST['userID']))
{
    $db = new MyDB();
    $db->exec( 'DELETE FROM categories_category WHERE id='.$_POST['userID']);
    header("Refresh:0; url=home.php");

}

 ?>
