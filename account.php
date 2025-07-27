<?php 
$pageTitle = "Mon Compte - LEA Web Creation";
$pageDescription = "Espace personnel de l'utilisateur sur LEA Web Creation.";
include 'config.php';
if(!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: login.php");
    exit();
}
include 'header.php'; 
?>

<h1>Mon Compte</h1>
<p>Bonjour, <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong> ! Vous êtes connecté.</p>

<!-- Section pour d'éventuelles informations du compte ou actions supplémentaires -->
<p>Bienvenue dans votre espace personnel. Ici, vous pourrez consulter et gérer vos informations et demandes.</p>

<p><a href="logout.php" class="btn">Déconnexion</a></p>

<?php include 'footer.php'; ?>
