<?php
    include 'bdd.php';
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($id === false) {
        // traiter l'erreur, l'id n'est pas valide
        echo "c'est pas bon";
    }
    else {
        $query = "DELETE FROM utilisateur WHERE utilisateur.idUtilisateur = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: gestuser.php");
    }
?>