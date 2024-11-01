<?php
include 'config.php';
include 'header.php';

// Récupération des services depuis la base de données
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<section id='services'>";
    echo "<h2>Nos Services</h2>";

    while ($row = $result->fetch_assoc()) {
        echo "<div class='service'>";
        echo "<img src='img/" . $row['image'] . "' alt='" . $row['nom'] . "' class='service-image'>";
        echo "<div class='service-text'>";
        echo "<h3>" . $row['nom'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Prix : " . $row['prix'] . " €</p>";
        echo "</div>"; // Fin de service-text
        echo "</div>"; // Fin de service
    }

    echo "</section>";
} else {
    echo "<p>Aucun service disponible.</p>";
}

$conn->close();
include 'footer.php';
?>
