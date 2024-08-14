<?php
include '../authentication.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $size = $_POST['size'];
    $newValue = $_POST['newValue'];

    // Update the database
    $sql = "UPDATE ktees_inventoryshirt SET $size = ? WHERE printingDetail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newValue, $category);
    $stmt->execute();
    $stmt->close();

    echo "Data updated successfully";
} else {
    echo "Invalid request";
}

$conn->close();
?>
