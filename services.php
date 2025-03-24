<?php
include 'config.php';
include 'header.php';

$sql = "SELECT * FROM services";
$result = $conn->query($sql);

echo "<section id='services' class='light-section'>";
echo "<h2>Nos Services</h2>";
echo "<div class='services'>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='service-item'>";
        echo "<img src='img/" . $row['image'] . "' alt='" . $row['nom'] . "' class='service-image'>";
        echo "<div class='service-text'>";
        echo "<h3>" . $row['nom'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p class='service-price'>Prix : " . $row['prix'] . " €</p>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>Aucun service disponible.</p>";
}

echo "</div>";
echo "</section>";

$conn->close();
include 'footer.php';
?>
