<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\db.sqlite3');
   }
}

if(isset($_POST['id']))
{
    $db = new MyDB();
    $db->exec( 'DELETE FROM blogs_Comment WHERE id='.$_POST['id']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

 ?>
