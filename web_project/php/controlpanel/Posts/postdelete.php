<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\..\db.sqlite3');
   }
}

if(isset($_POST['id']))
{
    $db = new MyDB();
    $db->exec('DELETE FROM blogs_nay WHERE nayed_id='.$_POST['id']);
    $db->exec('DELETE FROM blogs_yay WHERE yayed_id='.$_POST['id']);
    $db->exec('DELETE FROM blogs_blog WHERE id='.$_POST['id']);
    
    header("Refresh:0; url=index.php");

}

 ?>
