<?php

    include('../authentication.php');

    // Fetch data from the database table
    $sql = "SELECT * FROM ktees_product_sale"; 
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $conn->close();

    // Return the data in JSON format
    echo json_encode(array("data" => $data));
?>
