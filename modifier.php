<?php session_start(); 
if (!isset($_COOKIE['username'])) {
  session_destroy();
}
else{
  $expire = time() + 300;
  setcookie("username", $_SESSION['nom'], $expire);
}?>
<?php
 include 'bdd.php';
 $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
  if(isset($_POST['submit'])){
    $nom = $_POST['nom'];
    $description = $_POST['information'];
    $boite = $_POST['boite'];
    $etat = $_POST['etat'];
    $kilometre = $_POST['kilometre'];
    $anne = $_POST['anne'];
    $prix = $_POST['prix'];
    //image 1
    if(isset($_FILES['image1'])){
      $file1 = $_FILES['image1'];
      $fileName = $file1['name'];
      $fileTmpName = $file1['tmp_name'];
      $fileSize = $file1['size'];
      $fileError = $file1['error'];
      $fileType = $file1['type'];
      $fileDestination = 'image/' .uniqid(). $fileName;
      move_uploaded_file($fileTmpName, $fileDestination );
    }
    //image 2
    if(isset($_FILES['image2'])){
      $file2 = $_FILES['image2'];
      $fileName2 = $file2['name'];
      $fileTmpName2 = $file2['tmp_name'];
      $fileSize2 = $file2['size'];
      $fileError2 = $file2['error'];
      $fileType2 = $file2['type'];
      $fileDestination2 = 'image/'.uniqid() . $fileName2;
      move_uploaded_file($fileTmpName2, $fileDestination2);
    }
    //image 3
    if(isset($_FILES['image3'])){
      $file3 = $_FILES['image3'];
      $fileName3 = $file3['name'];
      $fileTmpName3 = $file3['tmp_name'];
      $fileSize3 = $file3['size'];
      $fileError3 = $file3['error'];
      $fileType3 = $file3['type'];
      $fileDestination3 = 'image/' .uniqid(). $fileName3;
      move_uploaded_file($fileTmpName3, $fileDestination3);
    }
    if(empty($fileName)){
      $data = array($nom, $description, $etat, $boite, $kilometre, $prix, $anne, $id);
      $stmt = $conn->prepare("UPDATE offre SET nom = ?, definition = ?, etat = ?, boite = ?, kilometrage = ?, prix = ?, annee = ? WHERE idOffre = ?");
      $stmt->execute($data);
    }
    else{
      $data = array($nom, $description, $etat, $boite, $kilometre, $prix, $anne, $fileDestination, $id);
      $stmt = $conn->prepare("UPDATE offre SET nom = ?, definition = ?, etat = ?, boite = ?, kilometrage = ?, prix = ?, annee = ?, url_img = ? WHERE idOffre = ?");
      $stmt->execute($data);
      $data = array($fileDestination, $fileDestination2, $fileDestination3, $id);
      $stmt = $conn->prepare("UPDATE image SET image1 = ?, image2 = ?, image3 = ? WHERE idImage = ?");
      $stmt->execute($data);
    }
    header("Location: gestionbien.php");
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
    
    <div class="container"> 
      <?php
        
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
          ?>
          <div class='card'>
            <div class='container'>
              <div class='row no-gutters'>
                <div class='col-md-4'>
                  <div id='carouselExampleSlidesOnly' class='carousel slide' data-bs-ride='carousel'>
                    <div class='carousel-inner'>
                      <?php $images =   array("image1" => $image['image1'], "image2" =>$image['image2'] , "image3" => $image['image3']);
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
        }?>         
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                    <form method="post" action="modifier.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                      <div id='bienvenue'class='container'> 
                        </div>               
                      </div>
                    </div>
                  </div>
                    <div class='col-md-7'>
                      <div class='card-body'>
                        <h2 class='card-title'>
                          <input type="text" id="nom form2Example11" class="form-control" name="nom" value="<?php echo $offre['nom'] ?>" required/>
                          <br/>
                        </h2>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-outline mb-4"> 
                              <?php
                                if ($boiteAuto) {
                                  echo '<select id = "boite form2Example11" class="form-select"name="boite">
                                          <option value="1">Automatique</option>
                                          <option value="0">Manuelle</option>
                                        </select>';
                                } else {
                                    echo '<select id = "boite form2Example11" class="form-select"name="boite">
                                            <option value="0">Manuelle</option>
                                            <option value="1">Automatique</option>
                                          </select>';
                                } ?>           
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-outline mb-4">  
                              <?php
                                if ($etat) {
                                  echo '<select id = "etat form2Example11" class="form-select"name="etat">
                                          <option value="1">Neuve</option>
                                          <option value="0">Occasion</option>
                                        </select>';
                                } else {
                                  echo '<select id = "etat form2Example11" class="form-select"name="etat">
                                          <option value="0">Occasion</option>
                                          <option value="1">Neuve</option>
                                        </select>';
                                } ?>     
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-outline mb-4">
                              <input type="text" id="kilometre form2Example11" class="form-control" name="kilometre" placeholder="Kilometre" value="<?php echo $offre['kilometrage']; ?> km" required/>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-outline mb-4">
                              <input type="text" id="anne form2Example11" class="form-control" name="anne" placeholder="Année" value="<?php echo $offre['annee'];?>" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p>
                    <br/>
                    <textarea id="information form2Example11" class="form-control" name="information" required><?php echo $offre['definition']; ?></textarea>
                  </p>
                  <p class='sousTitre'>
                    <input type="text" id="prix form2Example11" class="form-control" name="prix" placeholder="Prix" value="<?php echo $offre['prix']; ?>" required/>
                  </p>
                    <br>
                    <input type="file" name="image1" id="image1" class="form-control" accept="image/*" onchange="checkFile(this)" >
                    </br>
                    <input type="file" name="image2" id="image2" class="form-control" accept="image/*"disabled required>
                    </br>
                    <input type="file" name="image3" id="image3" class="form-control" accept="image/*"disabled required>
                    </br>
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <input type="submit" class="btn btn-outline-primary" name="submit" value="Modifier">
                    </div>
                  </div>
                </div>
                <?php
                  }   
                ?> 
              </div>
              
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
              <?php include 'footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>