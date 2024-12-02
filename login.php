<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $stmt = $conn->prepare("SELECT id, nom, prenom, mdp FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['mdp'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['prenom'];
        header("Location: account.php");
        exit;
    } else {
        $error = "Adresse e-mail ou mot de passe incorrect.";
    }
}
?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: #2e2e2e;
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
    .role-info {
        color: #4a90e2;
        font-weight: bold;
    }
</style>

<?php include 'header.php'; ?>

<main class="form-container">
    <h1>Connexion</h1>
    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="create_account.php">Créer un compte</a></p>
</main>

<?php include 'footer.php'; ?>
