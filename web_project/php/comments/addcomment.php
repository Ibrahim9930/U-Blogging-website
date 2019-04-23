<?php

class MyDB extends SQLite3 {
   function __construct() {
      $this->open('..\..\db.sqlite3');
   }
}

echo "string";

if (isset($_POST['content'])) {

$content=$_POST["content"];
$blog=$_POST["blog"];
$user=$_POST["user"];


$db = new MyDB();

$statement = $db->prepare('INSERT INTO "blogs_comment" ("id","content", "author_id", "post_id")
    VALUES (:id,:content, :author_id, :post_id)');
$query = 'select id from auth_user where username="'.$user.'"';
$ret = $db->query($query);
$row = $ret->fetchArray(SQLITE3_ASSOC);
$statement->bindValue(':author_id', $row['id']);
$statement->bindValue(':content', $content);
$statement->bindValue(':post_id', $blog);
$statement->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);

}


 ?>
