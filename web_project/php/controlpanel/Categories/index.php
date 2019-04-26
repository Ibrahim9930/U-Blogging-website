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
    background: #f8f8f8;
  }
</style>



<div class="container-fluied m-4">


  <div class="row"style="height:90vh;">
    <div class="col-8" style="padding: 10px;">

  <div class="row">
  <?php
  $db = new MyDB();
  $query =  "SELECT * FROM categories_category"; // to change whith post id
  $ret = $db->query($query);

  while($row = $ret->fetchArray(SQLITE3_ASSOC) )
   {
  echo '<div  id="'. $row["id"].'" class="card - mb-3" style=" margin:5px;width: 12rem;">';
  echo '  <div class="card-header">Category</div>
    <div class="card-body text-primary">';
    echo ' <h5 class="card-title">'. $row["name"] .'</h5>';
    echo ' <button name="'. $row["id"].'"type="button" class="btn btn-light" onclick="delete1(this)" style="width:100%;">Delete</button>
  </div> </div>';
}

   ?>

 </div>
</div>



<div class="col-4"  style="padding: 10px;">

   <form method="post" action="addc.php"  style="position:fixed;">
    <div class="form-group">
      <label for="exampleInputEmail1">Name:</label>
      <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name">
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">about</label>
      <textarea  name = "about"class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
     <label for="exampleFormControlFile1">Photo:</label>
     <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
   </div>
   <button name="submit" type="submit" class="btn btn-primary">Add</button>

<a href="http://127.0.0.1/U-Blogging-website/web_project/php/controlpanel/cpanel.php"> back</a>

   </form>


 </div>
</div>
</div>




<script type="text/javascript">
function delete1(e){

  if (confirm("Are you sure?")) {

      var name=e.name;
      document.getElementById(e.name).style.display="none";
    $.ajax({ url: 'deletec.php',
           data: "userID=" + name,
           type: 'post',
           success: function() {
                    }
    });


              } else {
              }




}

</script>

    </body>
</html>
