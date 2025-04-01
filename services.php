<?php
include 'config.php';
include 'header.php';

// Récupération des services depuis la base de données
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

echo "<section id='services'>";
echo "<h2>Nos Services</h2>";
echo "<div class='services'>"; // Conteneur pour organiser les services de manière similaire à l'accueil

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='service-item'>"; // Utilisation de la même classe que dans la page d'accueil pour cohérence
        echo "<div class='service-text'>";
        echo "<h3>" . $row['nom'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p class='service-price'>Prix : " . $row['prix'] . " €</p>";
        echo "</div>"; // Fin de service-text
        echo "</div>"; // Fin de service-item
    }
} else {
    echo "<p>Aucun service disponible.</p>";
}

echo "</div>"; // Fin de la div services
echo "</section>";

$conn->close();
include 'footer.php';
?>
