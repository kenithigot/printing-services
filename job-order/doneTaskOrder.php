<?php

    include('../authentication.php');

    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        // Prepare the SQL statement
        $stmt = $conn->prepare("DELETE FROM ktees_joborder WHERE id = ?");

        $stmt->bind_param("i", $id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

       
        $stmt->close();
        mysqli_close($conn);
    } else {
        echo json_encode(['success' => false]);
    }
?>
