<?php 
  session_start(); 
  if (!isset($_COOKIE['username'])) {
    session_destroy();
  }
  else{
    $expire = time() + 300;
    setcookie("username", $_SESSION['nom'], $expire);
  }

  $user_id = $_SESSION['nom']; // Récupération de l'identifiant de l'utilisateur à partir de la base de données
  $_SESSION['idUtilisateur'] = $user_id;
  if (isset($_SESSION['idUtilisateur'])) {
    // L'utilisateur est connecté
  } else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion.php");
    exit;
  }

  include 'bdd.php';




  if($_SESSION['admin'] == TRUE){
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
    
    
    <div class="container">
      <?php
        if(empty($_SESSION)){
          include "navconnexion.php";
        }
        else {
          include "navconnecter.php"; 
        }
        include 'bdd.php';
        $stmt = $conn->prepare("SELECT * FROM utilisateur ORDER BY nom ASC");
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll();
        

        ?><div class="row"><?php
        foreach ($utilisateurs as $utilisateur) {
      ?>
      
        <div class="col-sm-6">
          <div class='card'>
            <div class='card-body'>
              <?php $choix = $utilisateur['idUtilisateur'];?>
              <div class="d-flex flex-wrap justify-content-center">
                <div class="p-2"> 
                  <h2 class='card-title'><?php echo ucwords($utilisateur['nom']) ." ". ucwords($utilisateur['prenom']);?></h2>
                </div>
                <div class="p-2 ">   
                  <?php echo "<a href='modifieruser.php?id=$choix'><button type='button' class='btn btn-primary bouton'>Modifier</button></a>"; ?>
                </div>
                <div class="p-2 ">
                  <?php echo "<a href='supprimeruser.php?id=$choix'>"?><button type='button' onclick='return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");' class='btn btn-primary bouton'>Delete</button></a>
                </div>
              </div>  
            </div>  
          </div>
        </div>
      <?php 
        }
      ?>
      </div>
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
    
  </body>
</html>
<?php
}
else {
echo "Vous n'êtes pas toléré ici !";
}