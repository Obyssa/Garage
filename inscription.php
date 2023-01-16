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
  $host = 'localhost';
    $dbname = 'garagedestroisriviere';
    $username = 'Admin';
    $password = 'Gdtrrdvevev';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
?>
    <form method="post" action="inscription.php">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required>
      <br>
      <label for="prenom">Prénom :</label>
      <input type="text" id="prenom" name="prenom" required>
      <br>
      <label for="adresseMail">Adresse email :</label>
      <input type="email" id="adresseMail" name="adresseMail" required>
      <br>
      <label for="telephone">Numéro de téléphone :</label>
      <input type="text" id="telephone" name="telephone" required>
      <br>
      <label for="adresse">Adresse :</label>
      <input type="text" id="adresse" name="adresse" required>
      <br>
      <label for="postal">Code postal :</label>
      <input type="text" id="postal" name="postal" required>
      <br>
      <label for="pays">Pays :</label>
      <input type="text" id="pays" name="pays" required>
      <br>
      <label for="password">Mot de passe :</label>
      <input type="password" id="password" name="password" required>
      <br>
      <label for="password_confirm">Confirmer mot de passe :</label>
      <input type="password" id="password_confirm" name="password_confirm" required>
      <br>
      <input type="submit" name="submit" value="S'inscrire">
    </form>
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

      if ($password != $password_confirm) {
        echo "Les mots de passe ne correspondent pas";
        exit;
    }

    // Cryptage du mot de passe
    $options = [
        'cost' => 12,
    ];
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $options);

    // Connexion à la base de données
    

    // Préparation de la requête d'insertion des données
    $data = array($nom, $prenom, $email, $telephone, $adresse, $codeP, $pays, $password_hashed); 
    $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, adresseMail, telephone, adresse, codePostal, pays, mdp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute($data);

    
    // Exécution de la requête
    

    // Fermeture de la connexion à la base de données
    

    echo "Merci de votre inscription";
    }
    

    // Vérification de la correspondance des mots de passe
    

    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>