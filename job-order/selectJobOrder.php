<?php
    include('../authentication.php');

    if(isset($_POST["id"])){
        $id = $_POST["id"];

        // Prepare and execute the SQL query
        $sql = "SELECT * FROM ktees_order WHERE id = ?";
        $selectStmt = $conn->prepare($sql);
        $selectStmt->bind_param("i", $id);
        $selectStmt->execute();
        $result = $selectStmt->get_result();

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Database query failed']);
        }

        // Close the select statement
        $selectStmt->close();
        
        // Close connection
        $conn->close();
    }
?>
