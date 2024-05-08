<?php
include('../authentication.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["saveCredits"])) {
    // Check if all form fields are filled
    if (!empty($_POST["add-item"]) && !empty($_POST["add-quantity"]) && !empty($_POST["add-date"]) && !empty($_POST["add-price"])) {
        // Sanitize inputs to prevent SQL injection
        $item = mysqli_real_escape_string($conn, $_POST["add-item"]);
        $quantity = mysqli_real_escape_string($conn, $_POST["add-quantity"]);
        $date = mysqli_real_escape_string($conn, $_POST["add-date"]);
        $price = mysqli_real_escape_string($conn, $_POST["add-price"]);

        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO ktees_daily_sales (item, quantity, date, price) VALUES (?, ?, ?, ?)");
        
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("sdsd", $item, $quantity, $date, $price);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'New record created successfully',
                    }).then(() => {
                        window.location.href = '../sales/';
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
                    text: 'Failed to prepare statement',
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'All fields are required',
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Form not submitted',
        });
    </script>";
}

// Close connection
$conn->close();
?>
