<?php 
  session_start(); 
  if (!isset($_COOKIE['username'])) {
    session_destroy();
  }
  else{
    $expire = time() + 300;
    setcookie("username", $_SESSION['nom'], $expire);
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Garage Des Trois Rivières</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
    <link href="style.css" rel="stylesheet"/>
  </head>
  <body>
    <div>
      <?php
        include 'navbar2.php' 
      ?>
    </div>
    <div class="container">
      <script src="https://apps.elfsight.com/p/platform.js" defer>
      </script>
      <div class="elfsight-app-febbef4e-e778-4d84-97e9-383476b71683">
      </div>
    </div>
    <?php 
      include 'footer.php'
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
  </body>
</html>