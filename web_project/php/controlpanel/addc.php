<?php

function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\db.sqlite3');
   }
}

if (isset($_POST['name'])) {

$name=$_POST["name"];
$info=$_POST["about"];



$db = new MyDB();

$statement = $db->prepare('INSERT INTO "categories_category" ("id","name", "info", "slug")
    VALUES (:id,:uid, :url, :time)');
// $statement->bindValue(':id', 11);
$statement->bindValue(':uid', $name);
$statement->bindValue(':url', $info);
$statement->bindValue(':time', slugify($name) );
$statement->execute();

header("Refresh:0; url=home.php");
}
 ?>
