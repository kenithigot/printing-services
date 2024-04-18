<?php
    include('../authentication.php');

    if(isset($_POST["SaveAddClient"])){
        $client_name = $_POST["add-client_name"];
        $contactNum = $_POST["add-contactNum"];
        $clientAddress = $_POST["add-clientAddress"];
        $fb_account = $_POST["add-fb_account"];
        $email = $_POST["add-email"];

        $stmt = $conn->prepare("INSERT INTO ktees_client (client_name, contactNum, clientAddress, fb_account, email) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $client_name, $contactNum, $clientAddress, $fb_account, $email);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "<script>
            Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New record created successfully',
                    }).then(() => {
                        window.location.href = '../client/';
                    });
            </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
?>
