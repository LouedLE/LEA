<?php 
// Inclure la configuration (connexion BDD, session)
include_once 'config.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Balise meta description dynamique si définie -->
    <?php if(isset($pageDescription)): ?>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>" />
    <?php endif; ?>
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "LEA Web Creation"; ?></title>
    <!-- Fonte Montserrat importée avec uniquement les variantes nécessaires -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<header>
    <nav class="navbar" role="navigation">
        <!-- Logo du site (texte ou image avec alt) -->
        <a href="index.php" class="logo">LEA Web Creation</a>
        <!-- Menu de navigation principal -->
        <ul class="nav-menu" id="nav-menu">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="a-propos.php">À propos</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="account.php">Mon Compte</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
            <li><a href="login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
        <!-- Bouton menu hamburger pour mobile -->
        <button class="hamburger" aria-label="Menu" aria-controls="nav-menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </nav>
</header>
<main>
