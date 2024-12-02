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
    <title>Créer un Compte</title>
</head>
<body>
<header class="dark-header">
    <h1>Créer un Compte</h1>
</header>
<main>
    <section id="create-account" class="light-section">
        <div class="form-container">
            <form method="POST" action="create_account.php">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" required>
                
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>
                
                <label for="email">Adresse Email</label>
                <input type="email" name="email" id="email" required>
                
                <label for="mdp">Mot de Passe</label>
                <input type="password" name="mdp" id="mdp" required>
                
                <label for="role">Rôle</label>
                <select name="role" id="role" required>
                    <option value="Particulier">Particulier</option>
                    <option value="Professionnel">Professionnel</option>
                </select>
                
                <button class="cta-button" type="submit">Créer un Compte</button>
            </form>
        </div>
    </section>
</main>
</body>
</html>
