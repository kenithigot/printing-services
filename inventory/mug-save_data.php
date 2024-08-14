<?php
    include('../authentication.php');

    if (isset($_POST['newQuantity'])) {
        $newQuantity = $_POST['newQuantity'];
        $id = 1; // Change this to the correct ID you're updating

        $query = "UPDATE ktees_inventoryotherproduct SET mugQuantity = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $newQuantity, $id); // "ii" indicates two integer parameters

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt->close();
        $conn->close();
    }
?>
