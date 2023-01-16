<?php

    // Connexion à la base de données
    $host = 'localhost';
    $dbname = 'garagedestroisriviere';
    $username = 'Admin';
    $password = '*******************';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

?>