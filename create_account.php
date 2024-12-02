<?php
// Connexion à la base de données
include 'header.php';
include 'config.php';

// Vérification de la connexion
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']);

    // Insertion dans la table `users`
    $stmt = $conn->prepare("INSERT INTO users (nom, prenom, email, mdp, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $nom, $prenom, $email, $mdp, $role);

    if ($stmt->execute()) {
        echo "Compte créé avec succès. <a href='login.php'>Connectez-vous ici</a>";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<form action="create_account.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>

    <label for="role">Type de compte :</label>
    <select id="role" name="role" required>
        <option value="particulier">Particulier</option>
        <option value="professionnel">Professionnel</option>
    </select>

    <button type="submit">Créer un compte</button>
</form>
