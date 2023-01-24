<?php session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage Des Trois Rivières</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"/>
    <script src="script.js"></script>
  </head>
  <body>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item carousel-image bg-img-1 active">
        </div>
        <div class="carousel-item carousel-image bg-img-2">  
        </div>
        <div class="carousel-item carousel-image bg-img-3"> 
        </div>
        <?php include 'navbar.php'?>
        <div id="bienvenue"class="container">
          <h1 class="phraseBienvenue">
            DEPUIS 
            <script>
              document.write(new Date().getFullYear() - 2007);
            </script>
             ANS
          </h1>
          <hr class="phraseBienvenue trait"/>
          <div class="phraseBienvenue">
            <h3>
              Entretien & réparation
            </h3>
          </div>
          <div class="phraseBienvenue">
            <h5>
              VENTE VEHICULE NEUF OU OCCASION
            </h5>
          </div>
          <div class="wrapper">
              
          </div>        
        </div>
      </div> 
    </div> 
    <?php 
      if(empty($_SESSION)){
        include "navconnexion.php";
      }
      else {
        echo "<nav id = 'navbar2' class='navbar navbar-expand-lg navbar-light'>";
        include "navconnecter.php"; 
        echo "</div>";
        echo "</nav>";
      }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-7">
          <div class="titre">
            PRÉSENTATION
            <hr/>
          </div>
          <div class="sousTitre">
            Garage des 3 Rivières à Is-sur-Tille près de Dijon en Bourgogne
          </div>
          <br/>
          <div class="text">
            Depuis 2007, nous avons le plaisir de vous accueillir au sein de notre garage et assurons vos travaux 
            de mécanique, de carrosserie, de peinture, entretiens et réparations toutes marques et 4×4. Vous trouverez 
            également dans notre garage un choix varié d’accessoires et pièces de rechange en tous genres.
            <br/>
            <br/>
            <br/>
            <div class="sousTitre">
              Nos services +
            </div>
            <br/>
            Vente de pièces de rechange
            <br/>
            Vente et pose d’accessoires
            <br/>
            Prêt de véhicule gratuit
            <br/>
          </div>
        </div>
        <div class="col-sm-5">
          <img class="image" src="image/devant.jpg"/>
        </div>
        <br/>
        <br/>
        <div class="col-sm-5">
          <img class="image" src="image/voiture.jpg">
        </div>
        <div class="col-sm-7">
          <div class="titre">
            OFFRE
            <hr/>
          </div>
          <div class="sousTitre">
            Découvrer nos annonce de voiture neuve ou d'occasion
          </div>
          <br/>
          <div class="text">
            Retrouvez les modèles disponibles à la vente au Garage des Trois Rivières ! Vous pouvez 
            également nous confier votre véhicule pour réaliser entretiens et réparations. 
            <br/>
            <br/>
            Un vendeur spécialisé se tient également à votre disposition pour vous renseigner concernant les 
            véhicules d’occasion et neufs. 
            <br/>
            <br/>
            <br/>
            <a href="offre.php">
              <button type="button" class="btn btn-primary bouton">
                Annonce
              </button>
            </a>
            <div class="sousTitre">   
            </div>
            <br/>
          </div>            
        </div>     
        <br/>
        <br/>
        <div class="col-sm-7">
          <div class="titre">
            AVIS
            <hr/>
          </div>
          <div class="sousTitre">
            Découvrer les avis laisser part nos clients
          </div>
          <br/>
          <div class="text">
            Retrouver tous les avis laisser part nos clients depuis 2007 et profitez-en pour nous donner le vôtre.
            <br/>
            <br/>
            <br/>
            <div class="sousTitre">
            <a href="avis.php">
              <button type="button" class="btn btn-primary bouton">
                Avis
              </button>
            </a>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
          </div>
        </div>
        <div class="col-sm-5">
          <img class="image" src="image/avis.png"/>
        </div>
      </div>
    </div>
    <?php include 'footer.php'?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>