<?php
include 'config.php';  // Inclure connexion BDD

// Vérifier que le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer et échapper les données du formulaire
    $nom       = trim($_POST['nom'] ?? "");
    $email     = trim($_POST['email'] ?? "");
    $telephone = trim($_POST['telephone'] ?? "");
    $service   = trim($_POST['service'] ?? "");
    $details   = trim($_POST['details'] ?? "");
    
    if($nom !== "" && $email !== "" && filter_var($email, FILTER_VALIDATE_EMAIL) && $service !== "") {
        // Préparer la requête d'insertion sécurisée
        $stmt = $conn->prepare("INSERT INTO devis (nom, email, telephone, service, details, date_demande) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $nom, $email, $telephone, $service, $details);
        $stmt->execute();
        $stmt->close();
        // Rediriger vers la page devis avec message de succès
        header("Location: devis.php?success=1");
        exit();
    } else {
        // Données invalides ou incomplètes, redirection sans succès
        header("Location: devis.php");
        exit();
    }
} else {
    // Accès direct non autorisé
    header("Location: index.php");
    exit();
}
?>
