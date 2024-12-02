<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']);

    $stmt = $conn->prepare("INSERT INTO users (nom, prenom, email, mdp, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nom, $prenom, $email, $password, $role);
    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Erreur lors de la création du compte.";
    }
}
?>

<?php include 'header.php'; ?>

<main class="form-container">
    <h1>Créer un compte</h1>
    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>

        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <label for="role">Type de compte :</label>
        <select name="role" id="role">
            <option value="Particulier">Particulier</option>
            <option value="Professionnel">Professionnel</option>
        </select>

        <button type="submit">Créer un compte</button>
    </form>
    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
</main>

<?php include 'footer.php'; ?>
