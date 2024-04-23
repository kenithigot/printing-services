<?php
    // Include necessary files
    include('../authentication.php');

    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE ktees_daily_expenses SET 'date' = ?, item = ?, category = ?, amount = ? WHERE id = ?");

        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssi", $_POST['date'], $_POST['item'], $_POST['category'], $_POST['amount'], $id);

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