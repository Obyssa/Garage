<?php

    // Connexion à la base de données
    $host = 'localhost';
    $dbname = 'garagedestroisriviere';
    $username = 'Admin';
    $passworddb = 'Gdtrrdvevev';

    $conn = new mysqli($host, $username, $passworddb, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>