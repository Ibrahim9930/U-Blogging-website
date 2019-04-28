<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\..\db.sqlite3');
   }
}

if(isset($_POST['userID']))
{
    $db = new MyDB();

    $query =  "SELECT * FROM blogs_blog where category_id=".$_POST['userID'];     // to change whith post id
    $ret = $db->query($query);
      while($row = $ret->fetchArray(SQLITE3_ASSOC) )
       {
         $db->exec('DELETE FROM blogs_nay WHERE nayed_id='.$row['id']);
         $db->exec('DELETE FROM blogs_yay WHERE yayed_id='.$row['id']);
         $db->exec('DELETE FROM blogs_blog  WHERE id='.$row['id']);
        }


        $db->exec('DELETE FROM categories_subscriber  WHERE category_id='.$_POST['userID']);

    $db->exec( 'DELETE FROM categories_category WHERE id='.$_POST['userID']);
    header("Refresh:0; url=home.php");

}

 ?>
