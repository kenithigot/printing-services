<?php
include('../authentication.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["SaveAddOrder"])) {
    // Check if all form fields are filled
    if (!empty($_POST["add-date"]) && !empty($_POST["add-item"]) && !empty($_POST["add-category"]) && !empty($_POST["add-amount"])) {
        // Sanitize inputs to prevent SQL injection
        $date = mysqli_real_escape_string($conn, $_POST["add-date"]);
        $item = mysqli_real_escape_string($conn, $_POST["add-item"]);
        $category = mysqli_real_escape_string($conn, $_POST["add-category"]);
        $amount = mysqli_real_escape_string($conn, $_POST["add-amount"]);

        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO ktees_daily_expenses (`date`, item, category, amount) VALUES (?, ?, ?, ?)");
        
        // Bind the parameters
        $stmt->bind_param("sssd", $date, $item, $category, $amount);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New record created successfully',
                }).then(() => {
                    window.location.href = '../expenses/';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to insert record',
                });
            </script>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'All fields are required',
            });
        </script>";
    }

    // Close connection
    $conn->close();
}
?>
