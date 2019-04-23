<?php

class MyDB extends SQLite3 {
   function __construct() {
      $this->open('C:\Users\khameesiyadjamoos\Desktop\django\U-Blogging-website-master\web_project\db.sqlite3');
   }
}

if (isset($_POST['name'])) {

$name=$_POST["name"];
$slug=$_POST["slug"];
$info=$_POST["about"];



$db = new MyDB();

$statement = $db->prepare('INSERT INTO "categories_category" ("id","name", "info", "slug")
    VALUES (:id,:uid, :url, :time)');
// $statement->bindValue(':id', 11);
$statement->bindValue(':uid', $name);
$statement->bindValue(':url', $info);
$statement->bindValue(':time', $slug);
$statement->execute();

header("Refresh:0; url=index.php");
}
 ?>
