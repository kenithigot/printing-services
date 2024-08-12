<?php
    include('../authentication.php');

    if (isset($_POST['newQuantity'])) {
        $newQuantity = $_POST['newQuantity'];

        $query = "UPDATE ktees_inventory SET mugQuantity = ? WHERE id = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $newQuantity);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt->close();
        $conn->close();
    }
?>
