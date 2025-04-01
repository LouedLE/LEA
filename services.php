
<!-- Services Section -->
<section id="services">
    <div class="container">
        <h2>Nos Services</h2>
        <div class="services-container">
            <div class="service-card">
                <img src="assets/images/web-design.jpg" alt="Web Design">
                <h3>Web Design</h3>
                <p>Création de designs modernes et responsifs adaptés à vos besoins.</p>
                <a href="#" class="button">En savoir plus</a>
            </div>
            <div class="service-card">
                <img src="assets/images/seo.jpg" alt="SEO">
                <h3>SEO & Référencement</h3>
                <p>Optimisation pour un meilleur positionnement sur les moteurs de recherche.</p>
                <a href="#" class="button">En savoir plus</a>
            </div>
            <div class="service-card">
                <img src="assets/images/ecommerce.jpg" alt="E-commerce">
                <h3>Solutions E-commerce</h3>
                <p>Développement de boutiques en ligne performantes et sécurisées.</p>
                <a href="#" class="button">En savoir plus</a>
            </div>
        </div>
    </div>
</section>

<style>
/* Services Section */
#services {
    padding: 60px 20px;
    background-color: var(--background-color);
    text-align: center;
}

.services-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.service-card {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px var(--shadow-color);
    text-align: center;
    max-width: 300px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px var(--shadow-color);
}

.service-card img {
    width: 100%;
    border-radius: 8px;
}

.service-card h3 {
    margin: 15px 0;
    color: var(--primary-color);
}

.service-card p {
    color: var(--text-color);
    font-size: 1rem;
}
</style>
