<?php
include 'config.php';
// Si une session est active, la détruire pour déconnexion
session_destroy();
// Rediriger vers la page d'accueil après déconnexion
header("Location: index.php");
exit();
?>
