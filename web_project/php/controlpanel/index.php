<?php
   ob_start();
   session_start();
   if (isset($_SESSION["username"]))
   {
     header("Refresh:0; url=cpanel.php");

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


    <style>

body{
background:  rgb(0,0,0);
}
.bg{
  background-color:;
  background:  url(bg.jpg);
  position: absolute;
  display: block;
  width: 100%;
  height:100vh;
  z-index: -1;
  opacity: 0.7;

}
            .form-signin {
               max-width: 330px;
               padding-top: 10%;
               margin: 0 auto;
               color: #017572;
            }

            .form-signin .form-signin-heading,
            .form-signin .checkbox {
               margin-bottom: 10px;
            }

            .form-signin .checkbox {
               font-weight: normal;
            }

            .form-signin .form-control {
               position: relative;
               height: auto;
               -webkit-box-sizing: border-box;
               -moz-box-sizing: border-box;
               box-sizing: border-box;
               padding: 10px;
               font-size: 16px;
            }

            .form-signin .form-control:focus {
               z-index: 2;
            }

            .form-signin input[type="email"] {
               margin-bottom: -1px;
               border-bottom-right-radius: 0;
               border-bottom-left-radius: 0;
               border-color:#017572;
            }

            .form-signin input[type="password"] {
               margin-bottom: 10px;
               border-top-left-radius: 0;
               border-top-right-radius: 0;
               border-color:#017572;
            }

            h2{
               text-align: center;
               color: #017572;
            }
         </style>

  </head>
  <body>
<div class="bg">
</div>
     <div class = "container form-signin">

        <?php
           $msg = '';

           if (isset($_POST['login']) && !empty($_POST['username'])
              && !empty($_POST['password'])) {

              if ($_POST['username'] == 'admin' &&
                 $_POST['password'] == 'admin') {

                 $_SESSION['valid'] = true;
                 $_SESSION['timeout'] = time();
                 $_SESSION['username'] = 'admin';

                 header("Refresh:0; url=cpanel.php");
              }else {
                 $msg = 'Wrong username or password';
              }
           }
        ?>
     </div> <!-- /container -->

     <div class = "container">

        <form class = "form-signin" role = "form"
           action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
           ?>" method = "post">
           <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
           <input type = "text" class = "form-control"
              name = "username" placeholder = "username "
              required autofocus></br>
           <input type = "password" class = "form-control"
              name = "password" placeholder = "password " required>
           <button class = "btn btn-lg btn-primary btn-block" type = "submit"
              name = "login">Login</button>
        </form>


     </div>

  </body>
</html>
