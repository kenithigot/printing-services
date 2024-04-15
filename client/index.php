<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client - Printing Services</title>

    <!-- Sidebar -->
    <?php include('../includes/sidebar.php'); ?>

    <!-- Navigation bar -->
    <?php include('../includes/topbar.php');?>

    <!-- Loading bar -->
    <?php include('../spinner.php');?>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="contain">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active fs-4"><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                <li class="breadcrumb-item fs-4" aria-current="page">Client</li>    
            </ul>
            <button id="add-client-btn" class="btn btn-primary">Add New Client</button>
            <table id="client-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Client</th>                 
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include your database connection file
                    include('../authentication.php');

                    // Query to fetch all data from the ktees_client table
                    $sql = "SELECT * FROM ktees_client";
                    $result = mysqli_query($conn, $sql);

                    // Check if any rows were returned
                    if (mysqli_num_rows($result) > 0) {
                        // Output data rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['client_name'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['contact_number'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // If no rows were returned, display a message
                        echo "<tr><td colspan='4'>No records found</td></tr>";
                    }
                    // Close the connection
                    mysqli_close($conn);
                    ?>
                </tbody>     
            </table>
        </div>
    </div> 

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#client-table').DataTable();

            // Add new client button click event
            $('#add-client-btn').click(function() {
                // Redirect to the page where you add a new client
                window.location.href = 'add_client.php';
            });
        });
    </script>
</body>
</html>
