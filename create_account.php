<?php 
$pageTitle = "Créer un Compte - LEA Web Creation";
$pageDescription = "Créez votre compte utilisateur pour accéder à l'espace client LEA Web Creation.";
include 'config.php';  // Inclure la configuration (BDD, session)
$registration_success = false;
$error_msg = "";

// Traitement du formulaire d'inscription
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et validation des données du formulaire
    $email = trim($_POST['email'] ?? "");
    $password = trim($_POST['password'] ?? "");
    $confirm = trim($_POST['confirm'] ?? "");
    if($email === "" || $password === "" || $confirm === "") {
        $error_msg = "Merci de remplir tous les champs.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "L'adresse email n'est pas valide.";
    } elseif($password !== $confirm) {
        $error_msg = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si l'email existe déjà
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0) {
            $error_msg = "Un compte existe déjà avec cet email.";
            $stmt->close();
        } else {
            $stmt->close();
            // Insérer le nouvel utilisateur avec mot de passe haché
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashedPassword);
            if($stmt->execute()) {
                $registration_success = true;
            } else {
                $error_msg = "Erreur lors de la création du compte. Veuillez réessayer.";
            }
            $stmt->close();
        }
    }
}

// Si inscription réussie, rediriger vers la page de connexion
if($registration_success) {
    header("Location: login.php?register=success");
    exit();
}

// Inclure le header après traitement
include 'header.php'; 
?>

<h1>Créer un compte</h1>
<?php if($error_msg): ?>
    <p class="error"><?php echo htmlspecialchars($error_msg); ?></p>
<?php endif; ?>
<form method="post" action="create_account.php">
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required />
    </div>
    <div class="form-group">
        <label for="confirm">Confirmez le mot de passe :</label>
        <input type="password" id="confirm" name="confirm" required />
    </div>
    <button type="submit" class="btn cta">Créer le compte</button>
</form>

<p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a>.</p>

<?php include 'footer.php'; ?>
