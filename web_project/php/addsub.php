<?php

class MyDB extends SQLite3 {
   function __construct() {
      $this->open('..\db.sqlite3');
   }
}

if (isset($_POST['user']))
 {

$cat=$_POST["cat"];
$user=$_POST["user"];

$db = new MyDB();


$query = 'select id from auth_user where username="'.$user.'"';
$ret = $db->query($query);
$row = $ret->fetchArray(SQLITE3_ASSOC);



$statement = $db->prepare('INSERT INTO "categories_subscriber" ("id","category_id", "member_id")
    VALUES (:id,:category_id, :member_id)');

$statement->bindValue(':category_id',$cat);
$statement->bindValue(':member_id', $row['id']);
$statement->execute();






}


?>
