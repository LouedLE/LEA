<?php
// config.php : Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lea_web_creation";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>
