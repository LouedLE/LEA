<?php 
$pageTitle = "Contactez-nous - LEA Web Creation";
$pageDescription = "Contactez l'équipe LEA Web Creation via notre formulaire de contact ou par téléphone/email.";
include 'header.php'; 
?>

<h1>Contactez-nous</h1>
<p>Nous sommes là pour vous aider ! N’hésitez pas à nous contacter via le formulaire ci-dessous ou par les moyens suivants :</p>

<h2>Informations de Contact</h2>
<p><strong>Email :</strong> <a href="mailto:leawebcreation@gmail.com">leawebcreation@gmail.com</a><br />
<strong>Téléphone :</strong> +33 6 15 91 93 05</p>

<h2>Formulaire de Contact</h2>
<form method="post" action="contact.php">
    <div class="form-row">
        <div class="field">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required />
        </div>
        <div class="field">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required />
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />
    </div>
    <div class="form-group">
        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn cta">Envoyer</button>
</form>

<?php include 'footer.php'; ?>
