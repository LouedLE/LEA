<?php

include 'header.php';
include 'config.php';

// Vérification de la connexion
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $mdp = $_POST['mdp'];

    $stmt = $conn->prepare("SELECT id, nom, prenom, mdp, role FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nom, $prenom, $hashed_mdp, $role);
        $stmt->fetch();

        if (password_verify($mdp, $hashed_mdp)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['role'] = $role;
            header('Location: account.php');
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Adresse e-mail non trouvée.";
    }

    $stmt->close();
}

$conn->close();
?>

<form action="login.php" method="POST">
    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>

    <button type="submit">Se connecter</button>
</form>
