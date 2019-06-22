<?php

ob_start();
session_start();

if(!isset($_SESSION['username']) )
{
  header("Refresh:0; url=../index.php");
}

?>

<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\..\db.sqlite3');
   }
}
 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>


<style media="screen">
  body{
    margin-top: 50px;
    background: #f8f8f8;
  }
</style>



<div class="container">

<a href="../cpanel.php">
  <h5 style="text-align:center; width="2%"">Home</h5>

</a>

<input style="margin-bottom:10px;" class="form-control" type="text" placeholder="Search" class="search" onchange="search(this)"  />


  <?php
  $db = new MyDB();
  $query =  "SELECT * FROM blogs_blog"; // to change whith post id
  $ret = $db->query($query);

  while($row = $ret->fetchArray(SQLITE3_ASSOC) )
   {
  echo '<div class="post"  id="'. $row["id"].'" name="'.$row['title'].'" class="card - mb-3" style=" margin-bottom:25px;width: 100%;">';
  echo '  <div class="card-header">Post</div>
    <div class="card-body text-primary">';
    echo ' <h5 class="card-title">'.$row['title'].'</h5>'.'

    <form class="" action="postdelete.php" method="post">
     <input type="text" name="id" value="'.$row['id'].'" hidden>
     <button type="button" onClick="confSubmit(this.form);"  style="float:right; color:black;" class="btn btn-link"> <b>Delete</b> </button>
     </form>



  </div> </div>';
}

   ?>





</div>




<script type="text/javascript">



function confSubmit(form) {
if (confirm("Are you sure you want to delete this post?")) {
form.submit();
}

else {
}
}



function search(a){

var posts=document.getElementsByClassName('post')
for(var i = 0; i < posts.length; i++) {
posts.item(i).style.display="none";
}
for(var i = 0; i < posts.length; i++) {
if( posts.item(i).getAttribute("name").toLowerCase().includes(a.value.toLowerCase())  ){
posts.item(i).style.display="block";
}
}


}

</script>

    </body>
</html>
