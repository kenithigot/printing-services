<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: ../');  // Redirect to landing page if not logged in
        exit;
    }
?>

<?php
    include('../authentication.php');

    $staffMembers = [
        "Kid Eumil T. Suco",
        "Leslie S. Suco",
        "Emelda T. Suco",
        "Rolannie R. Suco"
    ];
 
    $counts = [];
    
    $sql = "SELECT staff, COUNT(*) as count FROM ktees_order WHERE staff IN (?,?,?,?) GROUP BY staff";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", ...$staffMembers);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $counts[$row['staff']] = $row['count'];
    }
    
    foreach ($staffMembers as $name) {
        if (!isset($counts[$name])) {
            $counts[$name] = 0;
        }
    }
 ?>

<?php
    include('../authentication.php');
    
    // Get the current day
    $currentDay = date('l, j F, Y');
    
    // SQL query to sum up the productPrice for today's sales
    $dailySql = "SELECT SUM(REPLACE(productPrice, ',', '')) AS totalDailySales FROM ktees_product_sale WHERE date_ordered = '$currentDay' AND payment='Paid'";
    $dailyResult = $conn->query($dailySql);

    // Check if the daily query was successful
    if ($dailyResult->num_rows > 0) {
        // Fetch the daily result
        $dailyRow = $dailyResult->fetch_assoc();
        $totalDailySales = $dailyRow['totalDailySales'];
    } else {
        // If no sales for the current day, display a message or handle accordingly
        $totalDailySales = 0;
    }

    // Get the start and end dates of the current week
    $startDate = date('l, j F, Y', strtotime('monday this week'));
    $endDate = date('l, j F, Y', strtotime('sunday this week'));

    // SQL query to sum up the productPrice for the current week
    $weeklySql = "SELECT SUM(REPLACE(productPrice, ',', '')) AS totalWeeklySales FROM ktees_product_sale WHERE payment = 'Paid' AND STR_TO_DATE(date_ordered, '%W, %e %M, %Y') BETWEEN STR_TO_DATE('$startDate', '%W, %e %M, %Y') AND STR_TO_DATE('$endDate', '%W, %e %M, %Y')";
    $weeklyResult = $conn->query($weeklySql);

    // Check if the weekly query was successful
    if ($weeklyResult->num_rows > 0) {
    // Fetch the weekly result
        $weeklyRow = $weeklyResult->fetch_assoc();
        $totalWeeklySales = $weeklyRow['totalWeeklySales'];
    } else {
        // If no sales for the current week, display a message or handle accordingly
        $totalWeeklySales = 0;
    }

    // Get the start and end dates of the current month
    $startDate = date('l, j F, Y', strtotime('first day of this month'));
    $endDate = date('l, j F, Y', strtotime('last day of this month'));

    // SQL query to sum up the productPrice for the current month
    $monthlySql = "SELECT SUM(REPLACE(productPrice, ',', '')) AS totalMonthlySales FROM ktees_product_sale WHERE payment = 'Paid' AND STR_TO_DATE(date_ordered, '%W, %e %M, %Y') BETWEEN STR_TO_DATE('$startDate', '%W, %e %M, %Y') AND STR_TO_DATE('$endDate', '%W, %e %M, %Y')";
    $monthlyResult = $conn->query($monthlySql);

    // Check if the monthly query was successful
    if ($monthlyResult->num_rows > 0) {
        // Fetch the monthly result
        $monthlyRow = $monthlyResult->fetch_assoc();
        $totalMonthlySales = $monthlyRow['totalMonthlySales'];
    } else {
        // If no sales for the current month, display a message or handle accordingly
        $totalMonthlySales = 0.00;
    }

    // Close the connection
    $conn->close();
?>
 
 <?php
    include('../authentication.php');

    // Define the statuses to be counted
    $statuses = "'not yet started', 'started', 'ongoing'";

    $sql = "SELECT COUNT(*) as pending_count FROM ktees_order WHERE order_status IN ($statuses)";
    $result = $conn->query($sql);

    $pending_count = 0;

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $pending_count = $row['pending_count'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
?>


<!DOCTYPE html>
<html lang="en">                   
    <head>
        
        <title>Dashboard - Printing Services</title>
        
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

    <body >
    <div class="content">
        <div class="contain-staff">
        <h1>Sales</h1>
            <div class="contain">
                <!-- Cards -->
                <div class="row">
                    <!-- Earnings (Daily) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Earnings (Daily)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            Php <?php echo number_format($totalDailySales, 2); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Weekly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Earnings (Weekly)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Php <?php echo number_format($totalWeeklySales, 2); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Earnings (Monthly)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Php <?php echo number_format($totalMonthlySales, 2); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Pending Orders Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Orders</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending_count; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Cards -->
            </div>
        </div>
        <div class="contain-staff">
            <h1 style="padding-top:0">Staff</h1>
            <div class="contain">
                <!-- Cards -->
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            KID EUMIL T. SUCO
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 icon-staff">
                                            <i class="fas fa-clipboard-list"></i>
                                            <?php echo htmlspecialchars($counts["Kid Eumil T. Suco"]); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Leslie S. Suco</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 icon-staff">
                                            <i class="fas fa-clipboard-list"></i>
                                            <?php echo htmlspecialchars($counts["Leslie S. Suco"]); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Emelda T. Suco
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 icon-staff">
                                                    <i class="fas fa-clipboard-list"></i>
                                                    <?php echo htmlspecialchars($counts["Emelda T. Suco"]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Rolannie R. Suco</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 icon-staff">
                                            <i class="fas fa-clipboard-list"></i>
                                            <?php echo htmlspecialchars($counts["Rolannie R. Suco"]); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Cards -->  
            </div>
        </div>
        <div class="table-orders">
            <h1>Sales Record</h1>
            <table id="order-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cost</th>                 
                        <th>Payment</th>
                        <th>Order</th>                          
                        <th>Date Ordered</th>
                    </tr>
                </thead>
            </table> 
        </div>
        <div class="table-orders mt-4">
            <h1>History Details</h1>
            <table id="history-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Time</th>
                        <th>Date Operation</th> 
                        <th>Staff</th> 
                        <th>Order</th>                                      
                    </tr>
                </thead>
            </table> 
        </div>
        <!-- Footer bar -->
        <?php include('../includes/footer.php');?>
    </div>  
    </body>

    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Include jQuery and jQuery UI libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
    <!-- Include DataTables library -->
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script> 

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

    <script src="script.js"></script>
</html>


