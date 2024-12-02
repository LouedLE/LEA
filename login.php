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
    <title>Connexion</title>
</head>
<body>
<header class="dark-header">
    <h1>Connexion</h1>
</header>
<main>
    <section id="login" class="light-section">
        <div class="form-container">
            <form method="POST" action="login.php">
                <label for="email">Adresse Email</label>
                <input type="email" name="email" id="email" required>
                
                <label for="mdp">Mot de Passe</label>
                <input type="password" name="mdp" id="mdp" required>
                
                <button class="cta-button" type="submit">Se Connecter</button>
            </form>
        </div>
    </section>
</main>
</body>
</html>
