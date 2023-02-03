<?php session_start(); 
if (!isset($_COOKIE['username'])) {
  session_destroy();
}
else{
  $expire = time() + 300;
  setcookie("username", $_SESSION['nom'], $expire);
}

 include 'bdd.php';
 $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
  if(isset($_POST['submit'])){
    $administrateur = $_POST['boite'];
    $data = array($administrateur, $id);
    $stmt = $conn->prepare("UPDATE utilisateur SET admin = ? WHERE idUtilisateur = ?");
    $stmt->execute($data);
    header("Location: gestuser.php");
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
            $query = "SELECT * FROM utilisateur WHERE idUtilisateur = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $offre = $stmt->fetch();
        ?>
        <div class='container'>
            <div class='card'>
                <div class='row no-gutters'>
                    <form method="post" action="modifieruser.php?id=<?php echo $id; ?>" enctype="multipart/form-data">              
                        <div class='col-md-8'>
                            <div class='card-body'>
                                <h2 class='card-title'>
                                    <?php echo ucwords($offre['nom']) ." ".ucwords($offre['prenom']) ?>
                                    <br/>
                                </h2>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-outline mb-4"> 
                                            <label>Adresse Mail : </label>
                                            <?php echo $offre['adresseMail']; ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-outline mb-4">  
                                            <label>Téléphone : </label>
                                            <?php echo $offre['telephone']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-outline mb-4">
                                            <label>Adresse : </label>
                                            <?php echo $offre['adresse']." ".$offre['codePostal']." ".$offre['pays']; ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-outline mb-4">
                                            <label>Administrateur :</label>
                                            <?php 
                                                if($offre['admin']==TRUE){
                                                    ?><select id = "boite form2Example11" name="boite">
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select><?php
                                                }
                                                else {
                                                    ?>
                                                    <select id = "boite form2Example11" name="boite">
                                                        <option value="0">Non</option>
                                                        <option value="1">Oui</option>
                                                    </select>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <input type="submit" class="btn btn-outline-primary" name="submit" value="Modifier">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        include 'footer.php';
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>