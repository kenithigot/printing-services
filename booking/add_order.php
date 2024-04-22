<?php
// Include database connection
include('../authentication.php');

if(isset($_POST["saveOrder"])){
    // Sanitize inputs to prevent SQL injection
    $client_name = mysqli_real_escape_string($conn, $_POST["client_name"]);
    $order = mysqli_real_escape_string($conn, $_POST["add-order"]);
    $platNum = mysqli_real_escape_string($conn, $_POST["plate_number"]);
    $tarpSize = mysqli_real_escape_string($conn, $_POST["tarpaulinsize"]);
    $printEmbro = mysqli_real_escape_string($conn, $_POST["add-typePrintEmbro"]);
    $shirt = mysqli_real_escape_string($conn, $_POST["add-typeShirt"]);
    $cloth = mysqli_real_escape_string($conn, $_POST["add-typeCloth"]);
    $xs = mysqli_real_escape_string($conn, $_POST["xs"]);
    $s = mysqli_real_escape_string($conn, $_POST["s"]);
    $m = mysqli_real_escape_string($conn, $_POST["m"]);
    $l = mysqli_real_escape_string($conn, $_POST["l"]);
    $xl = mysqli_real_escape_string($conn, $_POST["xl"]);
    $xxl = mysqli_real_escape_string($conn, $_POST["xxl"]);
    $xxxl = mysqli_real_escape_string($conn, $_POST["3xl"]);
    $xxxxl = mysqli_real_escape_string($conn, $_POST["4xl"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $dateOrdered = mysqli_real_escape_string($conn, $_POST["add-dateOrdered"]);
    $staffName = mysqli_real_escape_string($conn, $_POST["add-staffName"]);
    $deadline = mysqli_real_escape_string($conn, $_POST["add-dateDeadline"]);
    $orderStatus = mysqli_real_escape_string($conn, $_POST["add-orderStatus"]);

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO ktees_order (client, type_order, plate_number, tarp_size, type_print, type_shirt, type_cloth, x_small, small, medium, large, x_large, xx_large, xxx_large, xxxx_large, quantity, date_ordered, staff, due_date, order_status) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssssssss", $client_name, $order, $platNum, $tarpSize, $printEmbro, $shirt, $cloth, $xs, $s, $m, $l, $xl, $xxl, $xxxl, $xxxxl, $quantity, $dateOrdered, $staffName, $deadline, $orderStatus);

    // Execute the statement
    if ($stmt->execute()) {
        // Success message
        echo json_encode(array("status" => "success", "message" => "New record created successfully"));
    } else {
        // Error message
        echo json_encode(array("status" => "error", "message" => "Error creating record: " . $stmt->error));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request
    echo json_encode(array("status" => "error", "message" => "Invalid request"));
}
?>
