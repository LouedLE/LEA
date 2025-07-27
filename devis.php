<?php 
$pageTitle = "Demande de Devis - LEA Web Creation";
$pageDescription = "Obtenez un devis personnalisé pour la réalisation de votre projet web.";
include 'header.php'; 
?>

<h1>Demande de Devis</h1>
<p>Remplissez le formulaire ci-dessous pour obtenir un devis gratuit et personnalisé.</p>

<?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p class="success">Merci, votre demande a bien été envoyée. Nous vous répondrons dans les plus brefs délais.</p>
<?php endif; ?>

<form method="post" action="submit_devis.php">
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required />
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" />
    </div>
    <div class="form-group">
        <label for="service">Service souhaité :</label>
        <select id="service" name="service" required>
            <option value="" disabled selected>-- Sélectionnez un service --</option>
            <option value="Site vitrine">Création de Site Vitrine</option>
            <option value="Site e-commerce">Développement de Site E-commerce</option>
            <option value="Application web">Application Web</option>
            <option value="Optimisation SEO">Optimisation SEO</option>
        </select>
    </div>
    <div class="form-group">
        <label for="details">Détails :</label>
        <textarea id="details" name="details" rows="4" placeholder="Décrivez votre projet (objectifs, fonctionnalités souhaitées...)" required></textarea>
    </div>
    <button type="submit" class="btn cta">Envoyer la demande</button>
</form>

<?php include 'footer.php'; ?>
