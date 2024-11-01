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
            echo "<p>Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p>Email non trouvé.</p>";
    }
}

$conn->close();
?>

<h2>Connexion</h2>
<form method="POST" action="login.php">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>

    <button type="submit">Se connecter</button>
</form>

<!-- Lien pour créer un compte -->
<p>Pas de compte ? <a href="create_account.php">Créez-en un ici</a>.</p>

<!-- Ajouter le script JavaScript -->
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
