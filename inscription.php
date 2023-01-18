<?php session_start(); ?>
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

      // Récupération des données du formulaire

      if(isset($_POST['submit'])){
        /* récupération des valeurs */
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['adresseMail'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $codeP = $_POST['postal'];
        $pays = $_POST['pays'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        
        include 'bdd.php';

        if ($password != $password_confirm) {
          echo "Les mots de passe ne correspondent pas";
          exit;
        }
        else{
          // Cryptage du mot de passe
          $options = [
            'cost' => 12,
          ];
          $password_hashed = password_hash($password, PASSWORD_BCRYPT, $options);

          // Préparation de la requête d'insertion des données
          $data = array($nom, $prenom, $email, $telephone, $adresse, $codeP, $pays, $password_hashed); 
          $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, adresseMail, telephone, adresse, codePostal, pays, mdp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->execute($data);
          echo "Merci de votre inscription";
          header("location: connexion.php");
        }
      }
    ?>
    <section class="h-100 gradient-form">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
                    <a href="index.php">Annuler</a>
                    <div class="text-center">
                      <h4 class="mt-1 mb-5 pb-1">Page Inscription</h4>
                    </div>
                    <form method="post" action="inscription.php">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-outline mb-4">
                            <input type="text" id="nom form2Example11" class="form-control" name="nom" placeholder="Nom" required/>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-outline mb-4">
                            <input type="text" id="prenom form2Example11" class="form-control" name="prenom" placeholder="Prenom"required/>
                          </div>
                        </div>
                      </div>
                      <input type="email" id="adresseMail form2Example11" class="form-control" name="adresseMail" placeholder="Email"required/>
                      <br>
                      <input type="text" id="telephone form2Example11" class="form-control" name="telephone" placeholder="Telephone"required/>
                      <br>
                      <input type="text" id="adresse form2Example11" class="form-control" name="adresse" placeholder="Adresse"required/>
                      <br>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-outline mb-4">
                            <input type="text" id="postal form2Example11" class="form-control" name="postal" placeholder="Code Postal"required/>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-outline mb-4">
                            <input type="text" id="pays form2Example11" class="form-control" name="pays" placeholder="Pays"required/>
                          </div>
                        </div>
                      </div>
                      <input type="password" id="password form2Example11" class="form-control" name="password" placeholder="Mot De Passe"required/>
                      <br>
                      <input type="password" id="password_confirm form2Example11" class="form-control" name="password_confirm" placeholder="Confirmation MDP"required/>
                      <br>
                      <div class="d-flex align-items-center justify-content-center pb-4">
                        <input type="submit" class="btn btn-outline-primary" name="submit" value="S'inscrire">
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
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>