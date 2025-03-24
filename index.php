<?php
include 'header.php';
include 'config.php';
?>

<section id="accueil" class="light-section">
    <div class="hero-content">
        <h1>Bienvenue chez LEA Web Creation</h1>
        <p>Votre partenaire pour des sites dynamiques, modernes, et professionnels.</p>
        <a href="contact.php" class="cta-button">Contactez-nous</a>
    </div>
</section>

<section id="expertise" class="dark-section">
    <div class="expertise-wrapper">
        <div class="expertise-images">
            <div class="column-left"></div>
            <div class="column-right"></div>
        </div>
        <div class="expertise-content">
            <h2>Notre Expertise</h2>
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
            $all_reviews = [];
            $query = "SELECT id, customer_name, review_text FROM reviews";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $all_reviews[] = $row;
                }
            }
            $result->free();

            $large_list = [];
            for ($i = 0; $i < 20; $i++) {
                $large_list = array_merge($large_list, $all_reviews);
            }

            shuffle($large_list);
            $last_two_ids = [];

            foreach ($large_list as $review) {
                if (in_array($review["id"], $last_two_ids)) {
                    continue;
                }

                echo '<blockquote>';
                echo '<p>"' . htmlspecialchars($review["review_text"]) . '"</p>';
                echo '<footer>— ' . htmlspecialchars($review["customer_name"]) . '</footer>';
                echo '</blockquote>';

                $last_two_ids[] = $review["id"];
                if (count($last_two_ids) > 2) {
                    array_shift($last_two_ids);
                }
            }
            ?>
        </div>
    </div>
</section>

<?php
include 'footer.php';
$conn->close();
?>

<script>
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
