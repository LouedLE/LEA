<?php
include 'config.php';
include 'header.php'; // Inclure le header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($mdp, $user['mdp'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: account.php");
            exit();
        } else {
            echo "<p class='error-message'>Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p class='error-message'>Email non trouvé.</p>";
    }
}

$conn->close();
?>

<section class="light-section">
    <h2>Connexion</h2>
    <form method="POST" action="login.php" class="contact-form">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required>

        <button type="submit" class="cta-button">Se connecter</button>
    </form>
    <p>Pas de compte ? <a href="create_account.php">Créez-en un ici</a>.</p>
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
