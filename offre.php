<?php session_start();?>
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
    </div>
    <?php include 'navbar2.php'?>
    
    <div class="container">
    <?php 
      if(empty($_SESSION)){
        include "navconnexion.php";
      }
      else {
        echo "<nav id = 'navbar2' class='navbar navbar-expand-lg navbar-light'>";
        echo "<a>Vente Automobile</a>";
        include "navconnecter.php"; 
        
        if($_SESSION['admin'] == 1){
          echo "<a class='boutonNav'>";
            echo "<button type='button' class='btn btn-primary'>
                    Ajouter/Retiré
                  </button>";
          echo "</a>";
        }
        echo "</div>";
        echo "</nav>";
      }
    ?>
        <?php include 'bdd.php'?>
        <?php
        
        $query = "SELECT * FROM offre ORDER BY prix ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $offres = $stmt->fetchAll();
        


        foreach ($offres as $offre) {
          $prix = $offre['prix'];
          $prix = chunk_split($prix, 3, ' ');
          $boiteAuto = $offre['boite'];
          $etat = $offre['etat'];

          echo "<div class='card'>";
          echo  "<div class='row no-gutters'>";
          echo   "<div class='col-md-4'>";
          echo    "<img  class='card-img' src='data:image/jpg;base64," . base64_encode($offre['url_img']) . "' alt='Image offre'>";
          echo   "</div>";
          echo   "<div class='col-md-8'>";
          echo    "<div class='card-body'>";
          echo     "<h2 class='card-title'>". ucwords($offre['nom']) ."</h2>";
          echo     "<div class='card-text'>". number_format($offre['kilometrage']) ." km</div>";
          
          echo  "<div class='card-text'>";
          if ($boiteAuto) {
              echo "Boîte automatique";
          } else {
              echo "Boîte manuelle";
          }
          echo "</div>";
         echo "<p class='card-text'>";
            if ($etat) {
                echo "Vente : Neuve";
            } else {
                echo "Vente : Occasion";
            }
          echo "</p>";
          echo     "<p class='sousTitre'>Prix : " . number_format($offre['prix'], 0, '', ' ') . " €</p>";
          $choix = $offre['idOffre'];
          echo "<a href='vente.php?id=$choix'><button type='button' class='btn btn-primary bouton'>Information</button></a>";
          
          echo    "</div>";
          echo  "</div>";
          echo "</div>";
          echo "</div>";
          
        }
      
        

      
      ?>
      <?php
      
      ?>
    </div>
    <?php include 'footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>