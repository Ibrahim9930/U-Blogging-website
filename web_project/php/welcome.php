<?php

 ?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Fresca" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </head>

  <style media="screen">
  *{
    margin: 0px;
  }
body{
  margin: 0px;
  padding: 0px;
}
    .bg{
      background:  url(bg.jpg);
      position: absolute;
      display: block;
      width: 100%;
      height:100vh;
      z-index: -1;
      background-position: center;
      background-size: cover;
      opacity: 0.8;


    }
  </style>

  <body>
    <div class="bg"></div>
<h1 style="color:rgb(240,248,255); margin-bottom: 20px;font-family: 'Fresca', sans-serif; font-size: 3em; text-align:center; padding-top:6%;" > Welcome to our club !! </h1>
<div class="container">


<div class="row">

  <div class="col-2"> </div>
  <div class="col-8">
    <form>

      <div class="form-row" style="">

        <div class="col">
          <input type="text" class="form-control" placeholder="First name">
        </div>

        <div class="col">
          <input type="text" class="form-control" placeholder="Last name">
        </div>

      </div>

    </form>

  </div>
  <div class="col-2"> </div>



</div>

<h1 style="color:rgb(240,248,255); text-align:center;">add your intrests !!</h1>

<div class="row" style="
  max-height: 500px;
  margin-top: 50px;
  overflow-y: scroll;
overflow-x: hidden;
  -webkit-overflow-scrolling: touch;

"
  >




      <?php
      class MyDB extends SQLite3 {
         function __construct() {
           $this->open('..\db.sqlite3');
         }
      }

      $db = new MyDB();
      $query =  "SELECT * FROM categories_category"; // to change whith post id
      $ret = $db->query($query);

      while($row = $ret->fetchArray(SQLITE3_ASSOC) )
       {
         echo '
         <div class="col-2" id="'. $row['id'].'">
           <div class="card text-center" style=" margin-bottom: 10px; width: 11rem; background:rgb(240,248,255);">
             <div class="card-body">
               <h5 class="card-title">'.$row['name'].'</h5>
               <button name="'. $row['id'].'" onclick="add(this)" type="button" class="btn btn-dark">Add</button>
             </div>
           </div>

         </div>
';
       }

       ?>








</div>

  <div class="row">
    <div class="col-4">
    </div>
    <div class="col-4">
      <button style="margin-top:50px; width:100%;" type="button" class="btn btn-primary btn-lg btn-block">Start</button>

    </div>

    <div class="col-4">
    </div>

</div>






</div>








<script type="text/javascript">
function add(e){
  var name=e.name;
  document.getElementById(e.name).style.display="none";
$.ajax({ url: 'addcat.php',
       data: "id=" + name,
       type: 'post',
       success: function() {
                }
});
}



</script>





  </body>
</html>
