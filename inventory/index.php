<!DOCTYPE html>
<html lang="en">                   
    <head>
        
        <title>Inventory - Printing Services</title>
        
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
        <style>
        /* Custom CSS for item containers */
        .inventory-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .item-container {
            position: relative;
            border: 1px solid #ccc; /* Border color */
            border-radius: 5px;
            padding: 20px;
            width: calc(50% - 20px); /* 50% width with gap */
            max-width: 400px; /* Maximum width */
            box-sizing: border-box;
        }

        .item-container h2 {
            margin-top: 0;
        }

        .item-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px; /* Added margin for spacing */
        }

        .restock-button {
            background-color: #007bff; /* Blue color, you can change this */
            color: #fff; /* Text color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: none; /* Hide initially */
        }

        .item-container:hover .restock-button {
            display: block; /* Show on hover */
        }

        .restock-button:hover {
            background-color: #0056b3; /* Darker blue on hover, you can change this */
        }
    </style>
    </head>
    <body >
        <!-- Main Content -->
    <div class="content">
        <div class="contain">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active fs-4"><a class="rm-link" href="../dashboard/">Dashboard</a></li>
                <li class="breadcrumb-item fs-4" aria-current="page">Inventory</li>
            </ul>
            
            <!-- Containers for Items -->
            <div class="inventory-container">
                <!-- T-shirt Container -->
                <div class="item-container">
                    <h2>T-shirt</h2>
                    <div class="item-description">
                        <p>Dryfit </p>
                        <p>Active</p>
                        <p>Cotton </p>
                        <button class="restock-button">Restock T-shirt</button>
                    </div>
                    <!-- Add any specific details or controls for T-shirts -->
                </div>
                
                <!-- Plate Number Container -->
                <div class="item-container">
                    <h2>Plate Number</h2>
                    <div class="item-description">
                        <p>Plate</p>
                        <button class="restock-button">Restock T-shirt</button>
                    </div>
                    <!-- Add any specific details or controls for Plate Numbers -->
                </div>
                
                <!-- Tarpaulin Container -->
                <div class="item-container">
                    <h2>Tarpaulin</h2>
                    <div class="item-description">
                        <p>3ft x 160ft</p>
                        <p>4ft x 160ft</p>
                        <p>5ft x 160ft</p>
                        <button class="restock-button">Restock T-shirt</button>
                    </div>
                    <!-- Add any specific details or controls for Tarpaulins -->
                </div>

                <!-- ID Container -->
                <div class="item-container">
                    <h2>School ID</h2>
                    <div class="item-description">
                        <p>Card</p>
                        <p>Lanyard</p>
                        <p>ID Holder</p>
                        <button class="restock-button">Restock T-shirt</button>
                    </div>
                    <!-- Add any specific details or controls for IDs -->
                </div>

                <div class="item-container">
                    <h2>Mug</h2>
                    <div class="item-description">
                        <p>Mug</p>
                        <button class="restock-button">Restock T-shirt</button>
                    </div>
                    <!-- Add any specific details or controls for IDs -->
                </div>

                <div class="item-container">
                    <h2>Photo ID</h2>
                    <div class="item-description">
                        <p>Photo Card 4r</p>                       
                        <button class="restock-button">Restock T-shirt</button>
                    </div>
                    <!-- Add any specific details or controls for IDs -->
                </div>

                <div class="item-container">
                    <h2>Bond Paper</h2>
                    <div class="item-description">
                        <p>Long</p>
                        <p>Short</p>
                        <p>A4</p>
                        <button class="restock-button">Restock T-shirt</button>
                    </div>
                    <!-- Add any specific details or controls for IDs -->
                </div>
            </div>
        </div>
    </div>
    </body>
    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

    <script src="script.js"></script>
</html>


