<?php session_start(); 
include 'bdd.php';
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if ($id === false) {
// traiter l'erreur, l'id n'est pas valide
  echo "c'est pas bon";
}
else {
  $query = "SELECT * FROM utilisateur WHERE idUtilisateur = :id";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $utilisateur = $stmt->fetch();
}
if($utilisateur['admin'] == TRUE){
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
      <?php
        include 'navbar2.php';
      ?>
      <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
                      <div class="text-center">
                        <h4 class="mt-1 mb-5 pb-1">Ajouter Bien</h4>
                      </div>
                      <form method="post" action="gestionbien.php" enctype="multipart/form-data">
                          <div class="row">
                            <div>
                              <div class="form-outline mb-4">
                                  <input type="text" id="nom form2Example11" class="form-control" name="nom" placeholder="Nom Offre" required/>
                              </div>
                            </div>
                          </div>
                          <div>
                              <div class="form-outline mb-4">
                                  <textarea id="information form2Example11" class="form-control" name="information" required></textarea>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-6">
                                  <div class="form-outline mb-4">     
                                      <select id = "boite form2Example11" class="form-select"name="boite">
                                          <option value="0">Manuelle</option>
                                          <option value="1">Automatique</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-6">
                                  <div class="form-outline mb-4">     
                                      <select id = "etat form2Example11" class="form-select"name="etat">
                                          <option value="0">Occasion</option>
                                          <option value="1">Neuve</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-outline mb-4">
                              <input type="text" id="kilometre form2Example11" class="form-control" name="kilometre" placeholder="Kilometre"required/>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-outline mb-4">
                              <input type="text" id="anne form2Example11" class="form-control" name="anne" placeholder="Année"required/>
                            </div>
                          </div>
                        </div>
                        <input type="text" id="prix form2Example11" class="form-control" name="prix" placeholder="Prix"required/>
                        <br>
                        <input type="file" name="image1" id="image1" class="form-control" accept="image/*" onchange="checkFile(this)">
                        </br>
                        <input type="file" name="image2" id="image2" class="form-control" accept="image/*" disabled>
                        </br>
                        <input type="file" name="image3" id="image3" class="form-control" accept="image/*" disabled>
                        </br>
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <input type="submit" class="btn btn-outline-primary" name="submit" value="Ajouter">
                        </div>
                      </form>                              
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center bg-indigo">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <img class="logoGarage"src="image/logo-garage-nom.png"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php
        if(isset($_POST['submit'])){
          $nom = $_POST['nom'];
          $description = $_POST['information'];
          $boite = $_POST['boite'];
          $etat = $_POST['etat'];
          $kilometre = $_POST['kilometre'];
          $anne = $_POST['anne'];
          $prix = $_POST['prix'];
          //image 1
          $file1 = $_FILES['image1'];
          $fileName = $file1['name'];
          $fileTmpName = $file1['tmp_name'];
          $fileSize = $file1['size'];
          $fileError = $file1['error'];
          $fileType = $file1['type'];
          $fileDestination = 'image/' . $fileName;
          move_uploaded_file($fileTmpName, $fileDestination);
          //image 2
          $file2 = $_FILES['image2'];
          $fileName2 = $file2['name'];
          $fileTmpName2 = $file2['tmp_name'];
          $fileSize2 = $file2['size'];
          $fileError2 = $file2['error'];
          $fileType2 = $file2['type'];
          $fileDestination2 = 'image/' . $fileName2;
          move_uploaded_file($fileTmpName2, $fileDestination2);
          //image 3
          $file3 = $_FILES['image3'];
          $fileName3 = $file3['name'];
          $fileTmpName3 = $file3['tmp_name'];
          $fileSize3 = $file3['size'];
          $fileError3 = $file3['error'];
          $fileType3 = $file3['type'];
          $fileDestination3 = 'image/' . $fileName3;
          move_uploaded_file($fileTmpName3, $fileDestination3);
          
          
          $data = array($nom, $description, $etat, $boite, $kilometre, $prix, $anne, $fileName);
          $stmt = $conn->prepare("INSERT INTO offre (nom, definition, etat, boite, kilometrage, prix, annee, url_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->execute($data);
          
          $data = array($fileName, $fileName2, $fileName3);
          $stmt = $conn->prepare("INSERT INTO image (image1, image2, image3) VALUE (?, ?, ?)");
          $stmt->execute($data);
        }
      ?>
      <div class="container">
        <?php
            include 'bdd.php';
          $stmt = $conn->prepare("SELECT * FROM offre ORDER BY prix ASC");
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
            echo    "<img  class='card-img' src='image/" . $offre['url_img'] . "' alt='Image offre'>";
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
            echo '<div class="row">';
            echo   '<div class="col-2">';
            echo     '<div class="form-outline mb-4">';    
            echo       "<a href='modifier.php?id=$choix'><button type='button' class='btn btn-primary bouton'>Modifier</button></a>";
            echo     '</div>';
            echo   '</div>';
            echo   '<div class="col-2">';
            echo     '<div class="form-outline mb-4">';
            ?>
              <?php echo "<a href='supprimer.php?id=$choix'>"?><button type='button' onclick='return confirm("Êtes-vous sûr de vouloir soumettre ce formulaire?");' class='btn btn-primary bouton'>Supprimer</button></a>
            <?php
            
            echo     '</div>';
            echo   '</div>';
            echo '</div>';
            echo    "</div>";
            echo  "</div>";
            echo "</div>";
            echo "</div>";
            
          }
        ?>
        
      </div>
      
      <script>
        function supprimer(){
          if (confirm("Etes vous sûr de vouloir supprimer cet élément?")) {
            // L'utilisateur a cliqué sur OK, on peut continuer avec la suppression
            // votre code pour supprimer
          } else {
            // L'utilisateur a cliqué sur Annuler, on ne fait rien
          }
        }
      </script>
      

      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
      </script>
      <script>
        function checkFile(input) {
          if (input.files && input.files[0]) {
            document.getElementById("image2").disabled = false;
            document.getElementById("image3").disabled = false;
          } else {
            document.getElementById("image2").disabled = true;
            document.getElementById("image3").disabled = true;
          }
        }
      </script>
    </body>
  </html>
  <?php
}
else {
  echo "Vous n'êtes pas toléré ici !";
}