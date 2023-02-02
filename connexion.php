<?php 
    session_start();
    session_destroy();
    session_start(); 
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Garage Des Trois Rivières</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
        <link href="style.css" rel="stylesheet"/>
        <script src="script.js"></script>
    </head>
    <body>  
        <?php
            if(isset($_POST['submit'])){
                // Récupération des données du formulaire
                $email = $_POST['adresseMail'];
                $password = $_POST['password'];
                // Connexion à la base de données
                include 'bdd.php';
                $data = array($email);
                $query = "SELECT * FROM utilisateur WHERE adresseMail = ?";
                // Préparation de la requête pour récupérer les informations de l'utilisateur
                $stmt = $conn->prepare($query);
                // Exécution de la requête
                $stmt->execute($data);
                // Récupération des résultats
                $utilisateur = $stmt->fetch();
                
                if (count($utilisateur) > 0) {
                    // Vérification du mot de passe
                    if (password_verify($password, $utilisateur['mdp'])) {
                        // Connexion réussie
                        $_SESSION['nom'] = $utilisateur['nom'];
                        $_SESSION['admin'] = $utilisateur['admin'];
                        echo "niquel";
                        // Définir le temps d'expiration du cookie à 5 minutes
                        $expire = time() + 300;

                        // Enregistrer le cookie sur l'ordinateur de l'utilisateur
                        setcookie("username", $_SESSION['nom'], $expire);

                        // Vérifier si le cookie a été enregistré
                        if(isset($_COOKIE["username"])) {
                        echo "Bienvenue " . $_COOKIE["username"];
                        } else {
                        echo "Cookie non défini";
                        }
                        // Détruire le cookie lorsque l'utilisateur est inactif pendant plus de 5 minutes
                        if(time() > $expire) {
                        setcookie("username", "", time() - 3600);
                        echo "Cookie expiré";
                        }
                        header("Location: index.php");
                    } else {
                        echo "Adresse email ou mot de passe incorrect";
                    }
                }
                else{
                    echo "Compte non-existant";
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
                                        <div class="text-center">
                                            <h4 class="mt-1 mb-5 pb-1">Page Connexion</h4>
                                        </div>
                                        <form method="post" action="connexion.php">
                                            <p>Connectez-vous à votre compte</p>
                                            
                                            <div class="form-outline mb-4">
                                                <input type="email" id="adresseMail" class="form-control" name="adresseMail" placeholder="Adresse Mail" required/>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" id="password" class="form-control" name="password" placeholder="Mot de Passe"required/>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <input type="submit" name="submit" class="btn btn-outline-primary" value="Connexion">
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <p class="mb-0 me-2">Pas de compte ?</p>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <a href="inscription.php"><button type="button" class="btn btn-outline-primary">Nouveau compte</button></a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <a class="btn btn-outline-primary" href="index.php">Annuler</a>
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