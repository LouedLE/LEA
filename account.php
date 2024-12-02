<?php

include 'header.php';
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

echo "<h1>Bienvenue, " . htmlspecialchars($_SESSION['prenom']) . " " . htmlspecialchars($_SESSION['nom']) . "</h1>";
echo "<p>Type de compte : " . htmlspecialchars($_SESSION['role']) . "</p>";
echo "<a href='logout.php'>Se déconnecter</a>";
?>
