<?php

include 'header.php';
include 'config.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Mon Compte</title>
</head>
<body>
<header class="dark-header">
    <h1>Mon Compte</h1>
</header>
<main>
    <section id="account" class="light-section">
        <div class="form-container">
            <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom']); ?>!</h2>
            <p>Email : <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p>Rôle : <?php echo htmlspecialchars($_SESSION['role']); ?></p>
            <a class="cta-button" href="logout.php">Se Déconnecter</a>
        </div>
    </section>
</main>
</body>
</html>
