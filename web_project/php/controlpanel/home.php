<?php

ob_start();
session_start();

if(!isset($_SESSION['username']) )
{
  header("Refresh:0; url=index.php");
}
 ?>



<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>control panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>

    <nav  class="navbar navbar-expand-lg  navbar-dark bg-dark fixed-top">
      <a style="margin-left:50%;"class="navbar-brand" href="#">U</a>
      <form class="form-inline d-flex" action="logout.php" method="post">
        <button class="btn btn-sm btn-outline-secondary m-1" type="submit">Logout</button>
      </form>
    </nav>



</div>

<div style="margin-top:5%;"class="container">
<div class="row">

  <div class="col-4">
    <h3 style="text-align:center;">categories</h3>
    <div class="card" style="width: 100%;">
    <ul class="list-group list-group-flush"style=" max-height: 500px;
    margin-bottom: 10px;
    overflow:scroll;
    -webkit-overflow-scrolling: touch;" >

<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\..\db.sqlite3');
   }
}
$db = new MyDB();
$query =  "SELECT * FROM categories_category"; // to change whith post id
$ret = $db->query($query);

while($row = $ret->fetchArray(SQLITE3_ASSOC) )
 {
echo '<div id="'. $row["id"].'" class="">';
echo'<li class="list-group-item">'. $row["name"] .'</li>';
echo ' <button name="'. $row["id"].'"type="button" class="btn btn-secondary btn-sm" onclick="delete1(this)" style="width:100%;">delete</button>';

 }

 ?>

</div>
  </ul>
 <form method="post" action="addc.php">
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
 <button name="submit" type="submit" class="btn btn-primary">Submit</button>
 </form>

</div>

  </div>

<div class="col-4">
  <h3 style="text-align:center;">Posts</h3>

  <div class="list-group" style=" max-height: 600px;
    margin-bottom: 10px;
    overflow:scroll;
    -webkit-overflow-scrolling: touch;">



    <?php

    $db = new MyDB();
    $query =  "SELECT * FROM blogs_blog"; // to change whith post id
    $ret = $db->query($query);

    while($row = $ret->fetchArray(SQLITE3_ASSOC) )
     {

    echo '   <div href="#" style="margin-top:5px;" class="list-group-item list-group-item-action active">
         <div class="d-flex w-100 justify-content-between">
           <h5 class="mb-1">'.$row['title'].'</h5>
         </div>
         <form class="" action="postdelete.php" method="post">
          <input type="text" name="id" value="'.$row['id'].'" hidden>
          <button type="submit" style="float:right; color:black;" class="btn btn-link"> <b>Delete</b> </button>
          </form>
       </div>
       ';

     }

     ?>




  </div>


</div>


<div class="col-4">
  <h3 style="text-align:center;">Posts</h3>

  <div class="list-group" style=" max-height: 600px;
    margin-bottom: 10px;
    overflow:scroll;
    -webkit-overflow-scrolling: touch;">



    <?php

    $db = new MyDB();
    $query =  "SELECT * FROM auth_user"; // to change whith post id
    $ret = $db->query($query);

    while($row = $ret->fetchArray(SQLITE3_ASSOC) )
     {
//edit table and put filed activated
    echo '   <div href="#" style="margin-top:5px;" class="list-group-item list-group-item-action active">
         <div class="d-flex w-100 justify-content-between">
           <h5 class="mb-1">'.$row['username'].'</h5>
         </div>
         <form class="" action="postdelete.php" method="post">
          <input type="text" name="id" value="'.$row['id'].'" hidden>
          <button type="submit" style="float:right; color:black;" class="btn btn-link"> <b>Deactivate</b> </button>
          </form>
       </div>
       ';

     }

     ?>




  </div>


</div>


</div>

</div>





<script type="text/javascript">
function delete1(e){
  var name=e.name;
  document.getElementById(e.name).style.display="none";
$.ajax({ url: 'deletec.php',
       data: "userID=" + name,
       type: 'post',
       success: function() {
                }
});
}

</script>



  </body>
</html>
