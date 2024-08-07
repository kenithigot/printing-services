<?php
    include '../authentication.php';

    $categories = [
        'T-shirt with Print Dryfit White',
        'T-shirt with Print Dryfit Colored',
        'T-shirt with Print Cotton White',
        'T-shirt with Print Cotton Colored',
        'Poloshirt with print Dryfit White',
        'Poloshirt with print Dryfit Colored',
        'Poloshirt with print Cotton White',
        'Poloshirt with print Cotton Colored'
    ];

    $inventory = [];

    foreach ($categories as $category) {
        $sql = "SELECT xs, s, m, l, xl, xxl, xxxl, xxxxl FROM ktees_inventory WHERE printingDetail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        $inventory[$category] = $result->fetch_assoc();
        $stmt->close();
    }

    $conn->close();
?>
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
                        <h2>T-shirt Printing</h2>
                        <div class="item-description">
                            <table class="printtable">
                                <tr>
                                    <th style="text-align:left">TSHIRT</th>
                                </tr>
                                <tr>
                                    <th>Dryfit</th>
                                    <th>XS</th>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>L</th>
                                    <th>XL</th>
                                    <th>2XL</th>
                                    <th>3XL</th>
                                    <th>4XL</th>
                                </tr>
                                <tr>
                                    <td>White:</td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="xs">
                                        <?= $inventory['T-shirt with Print Dryfit White']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="s">
                                        <?= $inventory['T-shirt with Print Dryfit White']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="m">
                                        <?= $inventory['T-shirt with Print Dryfit White']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="l">
                                        <?= $inventory['T-shirt with Print Dryfit White']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="xl">
                                        <?= $inventory['T-shirt with Print Dryfit White']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="xxl">
                                        <?= $inventory['T-shirt with Print Dryfit White']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="xxxl">
                                        <?= $inventory['T-shirt with Print Dryfit White']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit White" data-size="xxxxl">
                                        <?= $inventory['T-shirt with Print Dryfit White']['xxxxl'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Colored:</td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="xs">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="s">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="m">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="l">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="xl">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="xxl">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="xxxl">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Dryfit Colored" data-size="xxxxl">
                                        <?= $inventory['T-shirt with Print Dryfit Colored']['xxxxl'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cotton</th>
                                </tr>
                                <tr>
                                    <td>White:</td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="xs">
                                        <?= $inventory['T-shirt with Print Cotton White']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="s">
                                        <?= $inventory['T-shirt with Print Cotton White']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="m">
                                        <?= $inventory['T-shirt with Print Cotton White']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="l">
                                        <?= $inventory['T-shirt with Print Cotton White']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="xl">
                                        <?= $inventory['T-shirt with Print Cotton White']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="xxl">
                                        <?= $inventory['T-shirt with Print Cotton White']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="xxxl">
                                        <?= $inventory['T-shirt with Print Cotton White']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton White" data-size="xxxxl">
                                        <?= $inventory['T-shirt with Print Cotton White']['xxxxl'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Colored:</td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="xs">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="s">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="m">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="l">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="xl">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="xxl">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="xxxl">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="T-shirt with Print Cotton Colored" data-size="xxxxl">
                                        <?= $inventory['T-shirt with Print Cotton Colored']['xxxxl'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align:left">POLO</th>
                                </tr>
                                <tr>
                                    <th>Dryfit</th>
                                    <th>XS</th>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>L</th>
                                    <th>XL</th>
                                    <th>2XL</th>
                                    <th>3XL</th>
                                    <th>4XL</th>
                                </tr>
                                <tr>
                                    <td>White:</td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="xs">
                                        <?= $inventory['Poloshirt with print Dryfit White']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="s">
                                        <?= $inventory['Poloshirt with print Dryfit White']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="m">
                                        <?= $inventory['Poloshirt with print Dryfit White']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="l">
                                        <?= $inventory['Poloshirt with print Dryfit White']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="xl">
                                        <?= $inventory['Poloshirt with print Dryfit White']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="xxl">
                                        <?= $inventory['Poloshirt with print Dryfit White']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="xxxl">
                                        <?= $inventory['Poloshirt with print Dryfit White']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit White" data-size="xxxxl">
                                        <?= $inventory['Poloshirt with print Dryfit White']['xxxxl'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Colored:</td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="xs">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="s">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="m">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="l">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="xl">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="xxl">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="xxxl">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Dryfit Colored" data-size="xxxxl">
                                        <?= $inventory['Poloshirt with print Dryfit Colored']['xxxxl'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cotton</th>
                                </tr>
                                <tr>
                                    <td>White:</td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="xs">
                                        <?= $inventory['Poloshirt with print Cotton White']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="s">
                                        <?= $inventory['Poloshirt with print Cotton White']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="m">
                                        <?= $inventory['Poloshirt with print Cotton White']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="l">
                                        <?= $inventory['Poloshirt with print Cotton White']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="xl">
                                        <?= $inventory['Poloshirt with print Cotton White']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="xxl">
                                        <?= $inventory['Poloshirt with print Cotton White']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="xxxl">
                                        <?= $inventory['Poloshirt with print Cotton White']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton White" data-size="xxxxl">
                                        <?= $inventory['Poloshirt with print Cotton White']['xxxxl'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Colored:</td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="xs">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['xs'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="s">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['s'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="m">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['m'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="l">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['l'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="xl">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['xl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="xxl">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['xxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="xxxl">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['xxxl'] ?>
                                    </td>
                                    <td contenteditable="true" class="editable" data-category="Poloshirt with print Cotton Colored" data-size="xxxxl">
                                        <?= $inventory['Poloshirt with print Cotton Colored']['xxxxl'] ?>
                                    </td>
                                </tr>
                            </table><br>
                            <p><i><strong>Note:</strong> By Clicking the correspond sizes number above allows you to edit for tshirt stocks.</i></p>
                            <!-- <br><br>
                            <button class="restock-button" id="restock-shirtBtn">Restock T-shirt</button> -->
                        </div>
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
    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

    <script src="script.js"></script>
</html>


