<?php
include 'config.php';
include 'header.php'; // Inclure le header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (nom, prenom, email, mdp, role) VALUES ('$nom', '$prenom', '$email', '$mdp', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-message'>Compte créé avec succès! <a href='login.php'>Connectez-vous ici</a></p>";
    } else {
        echo "<p class='error-message'>Erreur: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>

<section class="light-section">
    <h2>Créer un compte</h2>
    <form method="POST" action="create_account.php" class="contact-form">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required>

        <label for="role">Rôle (1 ou 2) :</label>
        <input type="number" id="role" name="role" required>

        <button type="submit" class="cta-button">Créer un compte</button>
    </form>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll("section");
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
