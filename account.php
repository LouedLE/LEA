<?php
include 'config.php';
include 'header.php'; // Inclure le header

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT nom, prenom, email, role FROM users WHERE id = $user_id"; // Ajout de 'role' dans la requête
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    echo "<section class='account-section visible'>"; // Ajouter une classe pour le style
    echo "<h2 class='account-title'>Mon Compte</h2>";
    echo "<p><strong>Nom :</strong> " . htmlspecialchars($user['nom']) . "</p>";
    echo "<p><strong>Prénom :</strong> " . htmlspecialchars($user['prenom']) . "</p>";
    echo "<p><strong>Email :</strong> " . htmlspecialchars($user['email']) . "</p>";

    // Afficher le rôle de l'utilisateur
    if ($user['role'] == 1) {
        echo "<p><strong>Rôle :</strong> Administrateur</p>";
    } elseif ($user['role'] == 2) {
        echo "<p><strong>Rôle :</strong> Client</p>";
    } else {
        echo "<p><strong>Rôle :</strong> Inconnu</p>";
    }
    echo "</section>"; // Fermer la section
} else {
    echo "<p>Erreur : utilisateur non trouvé.</p>";
}

$conn->close();
?>

<a href="logout.php" class="cta-button">Déconnexion</a>

<!-- Ajouter le script JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll(".account-section"); // Changer le sélecteur
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
