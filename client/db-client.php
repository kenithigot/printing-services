<?php
    include('../authentication.php');

    // Fetch data from the database table
    $sql = "SELECT client_name, address, contact_number, email FROM ktees_client"; // Modify this query according to your table structure
    $result = $conn->query($sql);

    // Prepare an array to hold the data
    $data = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Add each row to the data array
            $data[] = $row;
        }
    }
    $conn->close();

    // Return the data in JSON format
    echo json_encode(array("data" => $data));
?>
