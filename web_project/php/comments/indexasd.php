<!DOCTYPE html>
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
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">U</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="``col``lapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Explore</a>
          </li>

          <li class="nav-item dropdown">
            <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Art</a>
              <a class="dropdown-item" href="#">Tech</a>
              <a class="dropdown-item" href="#">Food</a>
              <a class="dropdown-item" href="#">plapla</a>
              <a class="dropdown-item" href="#">plaplapla</a>
              <a class="dropdown-item" href="#">plaplaplapla</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">My A ccount</a>
          </li>
        </ul>
      </div>
      <form class="form-inline d-flex justify-content-end ">
        <button class="btn btn-sm btn-outline-secondary m-1" type="button">New post</button>
        <button class="btn btn-sm btn-outline-secondary m-1" type="button">Logout</button>
      </form>
    </nav>
<div class="container">
  <div class="row" style="margin-top:100px;">

    <?php
       class MyDB extends SQLite3 {
          function __construct() {
             $this->open('C:\Users\khameesiyadjamoos\Desktop\django\U-Blogging-website-master\web_project\db.sqlite3');
          }
       }

       function get_authour($id){
            $db = new MyDB();
            $query =  'SELECT * FROM accounts_uer where id ='.id.'"';
            $row = $ret->fetchArray(SQLITE3_ASSOC);
return $row["id"];
       }
       $db = new MyDB();
       $query =  "SELECT * FROM blogs_Comment "; // to change whith post id
       $ret = $db->query($query);
       while($row = $ret->fetchArray(SQLITE3_ASSOC) )
        {
          echo
             '    <div id= "'.$row["id"] . '"  style="max-width: 18rem; position:relative; margin-right:10px;" class="card text-white bg-primary mb-3" >'.
             '    <div class="card-body">'.
             '    <h5 class="card-title">'. $row["id"]  .'</h5>'.
             '    <p class="card-text">'.$row["content"] .' </p>';
          // if
             echo '<button name="'.$row["id"].'" style= " position: relative; bottom: 0px;"  id="delete" type="button" onclick="delete1(this)" class="btn btn-light">Delete</button>';

            echo '</div>'.'</div>';
        }

?>
<script type="text/javascript">
function delete1(e){
  var name=e.name;
  document.getElementById(e.name).style.display="none";
$.ajax({ url: 'deletecomment.php',
       data: "userID=" + name,
       type: 'post',
       success: function() {
                }
});
}

</script>

  </body>
</html>
