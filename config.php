<?php
// Paramètres de connexion à la base de données
$dbHost = "localhost";
$dbUser = "UTILISATEUR_BDD";
$dbPass = "MOT_DE_PASSE_BDD";
$dbName = "NOM_BDD";

// Connexion à la base de données avec gestion d'erreur
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données.");
}
$conn->set_charset("utf8mb4");

// Démarrage de la session (si pas déjà démarrée)
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
