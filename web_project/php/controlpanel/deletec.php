<?php
class MyDB extends SQLite3 {
   function __construct() {
      $this->open('C:\Users\khameesiyadjamoos\Desktop\django\U-Blogging-website-master\web_project\db.sqlite3');
   }
}

if(isset($_POST['userID']))
{
    $db = new MyDB();
    $db->exec( 'DELETE FROM categories_category WHERE id='.$_POST['userID']);
}

 ?>
