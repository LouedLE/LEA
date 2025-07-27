<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $service = htmlspecialchars($_POST['service']);
    $message = htmlspecialchars($_POST['message']);
    
    $sql = "INSERT INTO devis (nom, email, telephone, service, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nom, $email, $telephone, $service, $message);
    
    if ($stmt->execute()) {
        echo "<script>alert('Votre demande de devis a bien été envoyée. Nous vous contacterons bientôt.'); window.location.href='devis.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de l'envoi de votre demande. Veuillez réessayer.'); window.location.href='devis.php';</script>";
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: devis.php");
    exit();
}
?>