<?php
// Include necessary files
include('../authentication.php');

if (isset($_POST["id"])) {
    $id = $_POST["id"];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE ktees_joborder SET staffName = ?, jobRole = ?, typePrintEmbro = ?, typeShirt = ?, typeShirtOther = ?, typeCloth = ?, dateDeadline = ?, imagePictureLink = ?, orderStatus = ? WHERE id = ?");

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssssssi", $_POST['staffName'], $_POST['jobRole'], $_POST['typePrintEmbro'], $_POST['typeShirt'], $_POST['typeShirtOther'], $_POST['typeCloth'], $_POST['dateDeadline'], $_POST['imagePictureLink'], $_POST['orderStatus'], $id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Data updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update data']);
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    mysqli_close($conn);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>