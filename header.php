<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEA Web Creation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="logo.png">
</head>
<body>
<header id="main-header">
    <a href="index.php">Accueil</a>
    <a href="services.php">Services</a>
    <a href="portfolio.php">Portfolio</a>
    <a href="contact.php">Contact</a>
    <a href="a-propos.php">À propos</a>
    <a href="account.php">Mon compte</a>
</header>

<!-- Contenu de la page ici -->

<script>
// Fonction pour détecter le fond de la section visible et ajuster l'apparence du header
document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("main-header");
    const sections = document.querySelectorAll("section");

    function adjustHeaderStyle() {
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            const headerHeight = header.offsetHeight;

            if (rect.top <= headerHeight && rect.bottom > headerHeight) {
                const bgColor = window.getComputedStyle(section).backgroundColor;
                const rgbValues = bgColor.match(/\d+/g).map(Number);

                if (rgbValues[0] > 200 && rgbValues[1] > 200 && rgbValues[2] > 200) {
                    header.classList.add("light-header");
                    header.classList.remove("dark-header");
                } else {
                    header.classList.add("dark-header");
                    header.classList.remove("light-header");
                }
            }
        });
    }

    window.addEventListener("scroll", adjustHeaderStyle);
    adjustHeaderStyle();
});
</script>
</body>
</html>