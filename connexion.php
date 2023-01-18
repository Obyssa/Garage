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
    
    <form method="post" action="connexion.php">
        <label for="adresseMail">Adresse email :</label>
        <input type="email" id="adresseMail" name="adresseMail" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="submit"value="Connexion">
    </form>

        <?php
            if(isset($_POST['submit'])){
                // Récupération des données du formulaire
                $email = $_POST['adresseMail'];
                $password = $_POST['password'];

                include 'bdd.php';

                // Préparation de la requête pour récupérer les informations de l'utilisateur
                $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE adresseMail = ?");
                $stmt->bind_param("s", $email);

                // Exécution de la requête
                $stmt->execute();

                // Récupération des résultats
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    // Vérification du mot de passe
                    if (password_verify($password, $row['mdp'])) {
                        // Connexion réussie
                        
                        $_SESSION['nom'] = $row['nom'];
                        $_SESSION['admin'] = $row['admin'];
                        echo "niquel";
                        header("Location: index.php");
                    } else {
                        echo "Adresse email ou mot de passe incorrect";
                    }
                }

                // Fermeture de la connexion à la base de données
                $stmt->close();
                $conn->close();
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
                                    <div class="text-center">
                                        <h4 class="mt-1 mb-5 pb-1">Page Connexion</h4>
                                    </div>
                                    <form>
                                        <p>Connectez-vous à votre compte</p>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example11" class="form-control" placeholder="Nom Utilisateur" />
                                            <label class="form-label" for="form2Example11"></label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example22" class="form-control" placeholder="Mot de Passe"/>
                                            <label class="form-label" for="form2Example22"></label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <button type="button" class="btn btn-outline-primary">Connexion</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Pas de compte ?</p>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <a href="inscription.php"><button type="button" class="btn btn-outline-primary">Nouveau compte</button></a>
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