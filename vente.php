<?php session_start();
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage Des Trois Rivières</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"/>
  </head>
  <body>
    <div>
      <?php include 'navbar2.php' ?>
    </div>
      <?php include 'bdd.php'?>
    <div class="container"> 
      <?php
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if ($id === false) {
        // traiter l'erreur, l'id n'est pas valide
          echo "c'est pas bon";
        }
        else {
          $query = "SELECT * FROM offre WHERE idOffre = :id";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(':id', $id, PDO::PARAM_INT);
          $stmt->execute();
          $offre = $stmt->fetch();
          $query = "SELECT * FROM image WHERE idImage = :id";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(':id', $id, PDO::PARAM_INT);
          $stmt->execute();
          $image = $stmt->fetch();
          $prix = $offre['prix'];
          $prix = chunk_split($prix, 3, ' ');
          $boiteAuto = $offre['boite'];
          $etat = $offre['etat'];
          echo "<div class='card'>";
          echo  "<div class='container'>";
          echo    "<div class='row no-gutters'>";
          echo      "<div class='col-md-4'>";
          echo "<div id='carouselExampleSlidesOnly' class='carousel slide' data-bs-ride='carousel'>";
          echo "<div class='carousel-inner'>";
          
                $images =   array("image1" => $image['image1'], "image2" => $image['image2'], "image3" => $image['image3']);
                $i = 0;
                foreach($images as $image){
                  if($image != "image/"){
                      if($i == 0){
                        
                          echo "<div class='carousel-item carousel-image active vente'>";
                      } else {
                          echo "<div class='carousel-item carousel-image vente'>";
                      }
                      
                      echo '<img class="d-block w-100 card-img" src="' . $image . '" >';
                      echo '</div>';
                      
                      $i++;
                  }
                  
                }
                echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>';
          echo            "<div id='bienvenue'class='container'>";
          
          echo            "</div>";
          
               
          echo          "</div>";
          echo        "</div> ";
          echo      "</div>";
          echo      "<div class='col-md-7'>";
          echo        "<div class='card-body'>";
          echo          "<h2 class='card-title'>"
                          . ucwords($offre['nom']) .
                          "<br/>
                           <br/>
                         </h2>";
          echo          "<p class='card-text'>"
                          . number_format($offre['kilometrage']) ." km
                         </p>";
          echo          "<p class='card-text'>";
                          if ($boiteAuto) {
                              echo "Boîte automatique";
                          } else {
                              echo "Boîte manuelle";
                          }
          echo          "</p>";
          echo          "<p class='card-text'>";
                          if ($etat) {
                              echo "Vente : Neuve";
                          } else {
                              echo "Vente : Occasion";
                          }
          echo          "</p>";      
          echo        "</div>";
          echo      "</div>";
          echo    "</div>";
          echo    "<p>
                    <br/>"
                    . $offre['definition'] .
                  "</p>";
          echo    "<p class='sousTitre'>
                    Prix : " . number_format($offre['prix'], 0, '', ' ') . " €
                  </p>";
          echo  "</div>";
          echo "</div>";
          
        }
      ?> 
    </div>
    <?php include 'footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>