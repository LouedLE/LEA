<?php 
$pageTitle = "Connexion - LEA Web Creation";
$pageDescription = "Connectez-vous à votre espace client LEA Web Creation.";
include 'config.php';  // Connexion BDD, session
$error_msg = "";

// Traitement du formulaire de connexion
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? "");
    $password = trim($_POST['password'] ?? "");
    if($email === "" || $password === "") {
        $error_msg = "Veuillez entrer votre email et votre mot de passe.";
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()) {
            // Vérifier le mot de passe
            if(password_verify($password, $row['password'])) {
                // Succès : initialiser la session utilisateur
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $email;
                header("Location: account.php");
                exit();
            } else {
                $error_msg = "Mot de passe incorrect.";
            }
        } else {
            $error_msg = "Aucun compte trouvé pour cet email.";
        }
        $stmt->close();
    }
}

// Inclure le header après avoir éventuellement défini $error_msg
include 'header.php'; 
?>

<h1>Connexion</h1>
<?php 
// Message de succès d'inscription depuis create_account
if(isset($_GET['register']) && $_GET['register'] === "success"): ?>
    <p class="success">Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.</p>
<?php endif; ?>
<?php if($error_msg): ?>
    <p class="error"><?php echo htmlspecialchars($error_msg); ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required />
    </div>
    <button type="submit" class="btn cta">Se connecter</button>
</form>

<p>Pas de compte ? <a href="create_account.php">Créez-en un ici</a>.</p>

<?php include 'footer.php'; ?>
