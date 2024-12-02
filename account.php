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

<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #74ebd5, #acb6e5);
        color: #333;
    }
    .account-container {
        max-width: 800px;
        margin: 50px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    h1 {
        color: #4a90e2;
        font-size: 2rem;
    }
    .account-details {
        margin: 20px 0;
        text-align: left;
        line-height: 1.8;
    }
    .account-details p {
        font-size: 1.2rem;
        margin: 10px 0;
    }
    .account-details p strong {
        color: #333;
    }
    .button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background: #4a90e2;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1rem;
        transition: background 0.3s ease;
    }
    .button:hover {
        background: #357ab8;
    }
</style>

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
