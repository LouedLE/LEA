<?php
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $probleme = $_POST['probleme'];

    $sql = "INSERT INTO contact (nom, prenom, email, probleme) VALUES ('$nom', '$prenom', '$email', '$probleme')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Message envoyé avec succès!</p>";
    } else {
        echo "<p>Erreur: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>

<section id="contact" class="fade-in">
    <h2>Contactez-nous</h2>
    <p>Nous sommes là pour vous aider ! N'hésitez pas à nous contacter via le formulaire ci-dessous ou par les moyens suivants :</p>
    
    <div class="contact-info">
        <h3>Informations de Contact</h3>
        <p><strong>Email :</strong> <a href="mailto:leawebcreation@gmail.com">leawebcreation@gmail.com</a></p>
        <p><strong>Téléphone :</strong> <a href="tel:+33615913905">+33 6 15 91 93 05</a></p>
    </div>

    <form method="POST" action="contact.php">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="probleme">Message :</label>
        <textarea id="probleme" name="probleme" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
</section>

<?php
include 'footer.php';
?>
