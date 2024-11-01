<?php
// header.php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEA Web Creation</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="logo.png">
</head>
<body>
<header>
    <img src="img/logo.png" alt="Logo de LEA Web Creation" class="logo">
    <h1 class="site-title">LEA Web Creation</h1> <!-- Titre du site ajouté ici -->
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="a-propos.php">À propos</a></li>
            <li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="account.php">Mon Compte</a>
                <?php else: ?>
                    <a href="login.php">Connexion</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>

<!-- Le contenu de votre page (sections) sera ici -->

<!-- Ajoutez le script JavaScript juste avant la balise de fermeture </body> -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll("section");

    // Observer pour détecter quand les sections sont visibles
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    });

    sections.forEach(section => {
        observer.observe(section);
    });
});
</script>
</body>
</html>
