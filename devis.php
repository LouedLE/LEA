<?php
include 'config.php';
include 'header.php';
?>

<section id="devis">
    <h2>Demande de Devis</h2>
    <form action="submit_devis.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" required>
        
        <label for="service">Service souhaité :</label>
        <select id="service" name="service" required>
            <option value="site_vitrine">Création de Site Vitrine</option>
            <option value="ecommerce">Développement de Site E-commerce</option>
            <option value="web_app">Application Web</option>
            <option value="seo">Optimisation SEO</option>
        </select>
        
        <label for="message">Détails :</label>
        <textarea id="message" name="message" required></textarea>
        
        <button type="submit" class="cta-button">Envoyer la demande</button>
    </form>
</section>

<?php
include 'footer.php';
?>
