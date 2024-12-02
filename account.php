<?php
include 'header.php';
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupération des informations de l'utilisateur
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT nom, prenom, email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<?php include 'header.php'; ?>

<main class="account-container">
    <h1>Bienvenue, <?= htmlspecialchars($user['prenom']) ?> !</h1>
    <div class="account-details">
        <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
        <p><strong>E-mail :</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Type de compte :</strong> <?= htmlspecialchars($user['role']) ?></p>
    </div>
    <a href="logout.php" class="button">Se déconnecter</a>
</main>

<?php include 'footer.php'; ?>
