<?php
    include('../authentication.php');

    if(isset($_POST["saveJobOrder"])){
        $staffName = $_POST["add-staffName"];
        $jobRole = $_POST["add-jobRole"];
        $orderStatus = $_POST["add-orderStatus"];
        // Check if the POST variables are set before accessing them
        $typePrintEmbro = isset($_POST["add-typePrintEmbro"]) ? $_POST["add-typePrintEmbro"] : '';
        // Provide a default value for typeShirt
        $typeShirt = isset($_POST["add-typeShirt"]) ? $_POST["add-typeShirt"] : '';
        $typeShirtOther = isset($_POST["add-typeShirtOther"]) ? $_POST["add-typeShirtOther"] : '';
        $typeCloth = isset($_POST["add-typeCloth"]) ? $_POST["add-typeCloth"] : '';
        $dateDeadline = $_POST["add-dateDeadline"];
        $imagePictureLink = isset($_POST["add-imagePictureLink"]) ? $_POST["add-imagePictureLink"] : '';

        $stmt = $conn->prepare("INSERT INTO ktees_joborder (staffName, jobRole, typePrintEmbro, typeShirt, typeShirtOther, typeCloth, dateDeadline, imagePictureLink, orderStatus) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $staffName, $jobRole, $typePrintEmbro, $typeShirt, $typeShirtOther, $typeCloth, $dateDeadline, $imagePictureLink, $orderStatus);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "<script>
            Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New Task created successfully',
                    }).then(() => {
                        window.location.href = '../job-order/';
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
