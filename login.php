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
