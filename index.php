<?php
include 'header.php';
include 'config.php'; // Fichier pour la connexion à la BDD
?>

<section id="accueil" class="light-section">
    <div class="hero-content" id="hero-content">
        <h1 style="text-align: center;">Bienvenue chez LEA Web Creation</h1>
        <p>Votre partenaire pour des sites dynamiques, modernes, et professionnels qui captivent votre audience et améliorent votre présence en ligne.</p>
        <a href="contact.php" class="cta-button">Contactez-nous</a>
    </div>
</section>

<section id="expertise" class="dark-section">
    <div class="expertise-wrapper">
        <div class="expertise-images">
            <div class="column-left" id="column-left"></div>
            <div class="column-right" id="column-right"></div>
        </div>
        <div class="expertise-content">
            <h2 style="text-align: center;">Notre Expertise</h2>
            <p>Avec une expertise solide en développement web, LEA Web Creation offre des solutions adaptées à tous vos besoins numériques.</p>
            <ul>
                <li><strong>Développement Front-End</strong>: Interfaces modernes et intuitives.</li>
                <li><strong>Développement Back-End</strong>: Systèmes robustes et sécurisés.</li>
                <li><strong>Design Réactif</strong>: Adaptabilité sur tous les appareils.</li>
                <li><strong>Optimisation SEO</strong>: Techniques de référencement avancées.</li>
            </ul>
        </div>
    </div>
</section>

    <section id="avantages" class="light-section">
    <h2>Pourquoi Choisir LEA Web Creation ?</h2>
    <div class="advantages">
        <div class="advantage-item">
            <h3>Innovation</h3>
            <p>Nous suivons les dernières tendances et technologies pour offrir des solutions innovantes.</p>
        </div>
        <div class="advantage-item">
            <h3>Sur-mesure</h3>
            <p>Des sites personnalisés adaptés aux besoins spécifiques de chaque client.</p>
        </div>
        <div class="advantage-item">
            <h3>Fiabilité</h3>
            <p>Des sites performants et sécurisés garantissant une protection optimale des données.</p>
        </div>
        <div class="advantage-item">
            <h3>Support Continu</h3>
            <p>Assistance technique et mises à jour régulières après le lancement du site.</p>
        </div>
    </div>
</section>

        <section id="services-offered" class="dark-section">
    <h2>Nos Services</h2>
    <div class="services">
        <div class="service-item">
            <h3>Création de Sites Vitrines</h3>
            <p>Des sites élégants pour présenter votre entreprise et renforcer votre image de marque.</p>
        </div>
        <div class="service-item">
            <h3>Développement de Sites E-commerce</h3>
            <p>Des boutiques en ligne performantes avec des fonctionnalités avancées.</p>
        </div>
        <div class="service-item">
            <h3>Applications Web</h3>
            <p>Des applications web sur mesure pour améliorer vos processus métiers.</p>
        </div>
        <div class="service-item">
            <h3>Gestion de Contenu</h3>
            <p>Des CMS pour mettre à jour votre site facilement et rapidement.</p>
        </div>
    </div>
</section>

<section id="temoignages" class="light-section">
    <h2>Ce Que Disent Nos Clients</h2>
    <div class="testimonials">
        <div class="testimonial-slider">
            <?php
            // Récupérer tous les avis une fois
            $all_reviews = [];
            $query = "SELECT id, customer_name, review_text FROM reviews";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $all_reviews[] = $row;
                }
            }
            $result->free();

            // Multiplier les avis pour créer une grande liste
            $large_list = [];
            for ($i = 0; $i < 20; $i++) {
                $large_list = array_merge($large_list, $all_reviews);
            }

            // Mélanger la grande liste
            shuffle($large_list);

            // Stocke les deux derniers IDs affichés pour éviter les répétitions
            $last_two_ids = [];

            // Afficher les avis en vérifiant les répétitions dans les deux derniers avis
            foreach ($large_list as $review) {
                if (in_array($review["id"], $last_two_ids)) {
                    continue;
                }

                echo '<blockquote>';
                echo '<p>"' . htmlspecialchars($review["review_text"]) . '"</p>';
                echo '<footer>— ' . htmlspecialchars($review["customer_name"]) . '</footer>';
                echo '</blockquote>';

                // Mettez à jour le tableau des derniers avis affichés
                $last_two_ids[] = $review["id"];
                if (count($last_two_ids) > 2) {
                    array_shift($last_two_ids); // Supprimer l'ancien ID pour ne garder que les deux derniers
                }
            }
            ?>
        </div>
    </div>
</section>

<?php
include 'footer.php';
$conn->close(); // Ferme la connexion à la BDD
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const combinedSection = document.querySelector(".section-wrapper");
    const windowWidth = window.innerWidth;

    function handleScroll() {
        const rect = combinedSection.getBoundingClientRect();
        if (rect.top <= 0) {
            combinedSection.style.transform = `translateX(-${windowWidth}px)`;
        } else {
            combinedSection.style.transform = "translateX(0)";
        }
    }

    window.addEventListener("scroll", handleScroll);
});
</script>

<style>
.full-screen {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
    position: relative;
}

.full-screen-container {
    height: 100vh;
    overflow: hidden;
    position: relative;
}

.section-wrapper {
    display: flex;
    transition: transform 1s ease;
    width: 200vw;
}

.half-screen {
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

#avantages {
    background-color: #f9f9f9;
    color: #333;
}

#services-offered {
    background-color: #1D2024;
    color: #fff;
}

.advantage-item, .service-item {
    margin-bottom: 1em;
}
</style>

<script>
// Animation pour le slider des témoignages
document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector(".testimonial-slider");
    let startX = 0;
    const speed = 20;

    function animateTestimonials() {
        startX -= speed / 60;
        if (Math.abs(startX) >= slider.scrollWidth / 2) {
            startX = 0;
        }
        slider.style.transform = `translateX(${startX}px)`;
        requestAnimationFrame(animateTestimonials);
    }

    animateTestimonials();
});
</script>

<style>
.fade-out {
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 1s, transform 1s;
}

.fade-in {
    opacity: 1;
    transform: translateY(0);
    transition: opacity 1s, transform 1s;
}
</style>

<script>
// Animation pour les images dans la section expertise
document.addEventListener("DOMContentLoaded", function() {
    const imagesLeft = [
        "pexels-yankrukov-7693731.jpg",
        "annie-spratt-MChSQHxGZrQ-unsplash.jpg",
        "pexels-shvetsa-5325103.jpg"
    ];
    const imagesRight = [
        "brooke-cagle--uHVRvDr7pg-unsplash.jpg",
        "kenny-eliason-YHYHu_IuM3Q-unsplash.jpg",
        "pexels-armin-rimoldi-5553050.jpg"
    ];

    const columnLeft = document.getElementById("column-left");
    const columnRight = document.getElementById("column-right");

    function populateColumn(column, images) {
        for (let i = 0; i < 10; i++) {
            images.forEach(src => {
                const img = document.createElement("img");
                img.src = src;
                img.alt = "Image " + src;
                column.appendChild(img);
            });
        }
    }

    populateColumn(columnLeft, imagesLeft);
    populateColumn(columnRight, imagesRight);

    columnLeft.style.animation = "scrollColumnDown 60s linear infinite";
    columnRight.style.animation = "scrollColumnUp 90s linear infinite";
});
</script>

<style>
.expertise-wrapper {
    position: relative;
    overflow: hidden;
    height: 100vh;
}

.column-left, .column-right {
    display: flex;
    flex-direction: column;
}

@keyframes scrollColumnUp {
    0% { transform: translateY(0); }
    100% { transform: translateY(-100%); }
}

@keyframes scrollColumnDown {
    0% { transform: translateY(-100%); }
    100% { transform: translateY(0); }
}
</style>
</body>
</html>
