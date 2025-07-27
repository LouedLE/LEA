<?php
// config.php : Connexion à la base de données
$servername = "leawebbloued.mysql.db";
$username = "leawebbloued";
$password = "Lea161204";
$dbname = "leawebbloued";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>
