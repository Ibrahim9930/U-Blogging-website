<?php

 ?>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>U control panel</title>
   </head>
   <body>

<div class="navy">

<nav>
	<a href="http://127.0.0.1/U-Blogging-website/web_project/php/controlpanel/posts">Posts</a>
	<a href="#">Users</a>
	<a href="http://127.0.0.1/U-Blogging-website/web_project/php/controlpanel/categories/">Categories</a>
  <a href="logout.php">Log out</a>

</nav>
</div>





<style media="screen">

body {
  padding: 0px  ;
  margin: 0px;
display: flex;
justify-content: center;
align-items: center;
min-height: 100vh;
background: #f8f8f8;
font: normal 400 130%/1.5 -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
}

nav {
display: grid;
grid-auto-flow: column;
grid-gap: 1em;
}

a {
position: relative;
font-weight: 600;
text-decoration: none;
color: rgba(0, 0, 0, 0.4);
transition: color 0.3s ease;
}
a::after {
--scale: 0;
content: "";
position: absolute;
left: 0;
right: 0;
top: 100%;
height: 3px;
background: #4c81c9;
-webkit-transform: scaleX(var(--scale));
        transform: scaleX(var(--scale));
-webkit-transform-origin: var(--x) 50%;
        transform-origin: var(--x) 50%;
transition: -webkit-transform 0.3s cubic-bezier(0.535, 0.05, 0.355, 1);
transition: transform 0.3s cubic-bezier(0.535, 0.05, 0.355, 1);
transition: transform 0.3s cubic-bezier(0.535, 0.05, 0.355, 1), -webkit-transform 0.3s cubic-bezier(0.535, 0.05, 0.355, 1);
}
a:hover {
color: #4c81c9;
}
a:hover::after {
--scale: 1;
}

</style>

<script type="text/javascript">
document.querySelectorAll('a').forEach((elem) => {

elem.onmouseenter =
elem.onmouseleave = (e) => {

  const tolerance = 5

  const left = 0
  const right = elem.clientWidth

  let x = e.pageX - elem.offsetLeft

  if (x - tolerance < left) x = left
  if (x + tolerance > right) x = right

  elem.style.setProperty('--x', `${ x }px`)

}

})
</script>
   </body>
 </html>
