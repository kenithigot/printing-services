<?php
    include('../authentication.php'); // Include your authentication file

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id']) && isset($_POST['payment'])) {
            $id = intval($_POST['id']);
            $payment = $conn->real_escape_string($_POST['payment']);

            // Start a transaction
            $conn->begin_transaction();

            try {
                // Update ktees_order
                $sql_order = "UPDATE ktees_order SET payment = '$payment' WHERE id = $id";
                if (!$conn->query($sql_order)) {
                    throw new Exception($conn->error);
                }

                // Update ktees_product_sale
                $sql_sale = "UPDATE ktees_product_sale SET payment = '$payment' WHERE id = $id";
                if (!$conn->query($sql_sale)) {
                    throw new Exception($conn->error);
                }

                // Commit transaction if both queries succeed
                $conn->commit();
                echo json_encode(array("success" => true));

            } catch (Exception $e) {
                // Rollback transaction if any query fails
                $conn->rollback();
                echo json_encode(array("success" => false, "error" => $e->getMessage()));
            }

        } else {
            // Fetch data if no ID and payment provided
            $sql = "SELECT * FROM ktees_order WHERE payment = 'Not Paid'";
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
        }
    } else {
        echo json_encode(array("success" => false, "error" => "Invalid request method"));
    }
?>
