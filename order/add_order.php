<?php
// Include database connection
include('../authentication.php');

if(isset($_POST["saveOrder"])){
    // Sanitize inputs to prevent SQL injection
    $client_name = mysqli_real_escape_string($conn, $_POST["clientName"]);
    $order = mysqli_real_escape_string($conn, $_POST["add-order"]);
    $platNum = isset($_POST["plate_number"]) ? mysqli_real_escape_string($conn, $_POST["plate_number"]) : "";
    $tarpSize = isset($_POST["tarpaulinSize"]) ? mysqli_real_escape_string($conn, $_POST["tarpaulinSize"]) : "";
    $productId = isset($_POST["productId"]) ? mysqli_real_escape_string($conn, $_POST["productId"]) : "";
    $platenumPrice = isset($_POST["platenumPrice"]) ? mysqli_real_escape_string($conn, $_POST["platenumPrice"]) : "";
    $mugprice = isset($_POST["mugprice"]) ? mysqli_real_escape_string($conn, $_POST["mugprice"]) : "";
    $tarpLayout = isset($_POST["layoutTarp"]) ? mysqli_real_escape_string($conn, $_POST["layoutTarp"]) : "";
    $printEmbro = isset($_POST["typePrintEmbro"]) ? mysqli_real_escape_string($conn, $_POST["typePrintEmbro"]) : "";
    $printingDetail = isset($_POST["printingDetail"]) ? mysqli_real_escape_string($conn, $_POST["printingDetail"]) : "";
    $cost = (int) mysqli_real_escape_string($conn, $_POST["costItem"]);
    $xs = (int) mysqli_real_escape_string($conn, $_POST["xsmall"]);
    $s = (int) mysqli_real_escape_string($conn, $_POST["small"]);
    $m = (int) mysqli_real_escape_string($conn, $_POST["medium"]);
    $l = (int) mysqli_real_escape_string($conn, $_POST["large"]);
    $xl = (int) mysqli_real_escape_string($conn, $_POST["xlarge"]);
    $xxl = (int) mysqli_real_escape_string($conn, $_POST["2xlarge"]);
    $xxxl = (int) mysqli_real_escape_string($conn, $_POST["3xlarge"]);
    $xxxxl = (int) mysqli_real_escape_string($conn, $_POST["4xlarge"]);
    $commonQuantity = (int) mysqli_real_escape_string($conn, $_POST["commonQuantity"]);
    $mugQuantity = (int) mysqli_real_escape_string($conn, $_POST["mugQuantity"]);
    $dateOrdered = mysqli_real_escape_string($conn, $_POST["add-dateOrdered"]);
    $staffName = mysqli_real_escape_string($conn, $_POST["add-staffName"]);
    $deadline = mysqli_real_escape_string($conn, $_POST["add-dateDeadline"]);
    $orderStatus = mysqli_real_escape_string($conn, $_POST["add-orderStatus"]);
    $addpayment = mysqli_real_escape_string($conn, $_POST["add-payment"]);

    // Customer ID price
    $customerIdPrice = ["School ID" => 90, "Barangay ID" => 250, "Walk-In ID" => 100];

    //Plate Number promo price
    $plateNumberPrice = ["Promo" => 250, "Regular" => 300];

    //Mug Printing price
    $mugPrintingPrice = ["Promo Offer" => 100, "Regular Offer" => 150];
    
    // Specific prices per tarpaulin size and layout
    $tarpaulinPrices = [
        "2x3" => ["Without Layout" => 108, "With Layout" => 208, "With Layout + Rush Print" => 258],
        "2x4" => ["Without Layout" => 144, "With Layout" => 244, "With Layout + Rush Print" => 294],
        "2x5" => ["Without Layout" => 180, "With Layout" => 280, "With Layout + Rush Print" => 330],
        "2x6" => ["Without Layout" => 216, "With Layout" => 316, "With Layout + Rush Print" => 366],
        "2x7" => ["Without Layout" => 252, "With Layout" => 352, "With Layout + Rush Print" => 402],
        "2x8" => ["Without Layout" => 288, "With Layout" => 388, "With Layout + Rush Print" => 438],
        "2x9" => ["Without Layout" => 324, "With Layout" => 424, "With Layout + Rush Print" => 474],
        "2x10" => ["Without Layout" => 360, "With Layout" => 460, "With Layout + Rush Print" => 510],
        "2x11" => ["Without Layout" => 396, "With Layout" => 496, "With Layout + Rush Print" => 546],
        "2x12" => ["Without Layout" => 432, "With Layout" => 532, "With Layout + Rush Print" => 582],
        "2x13" => ["Without Layout" => 468, "With Layout" => 568, "With Layout + Rush Print" => 618],
        "2x14" => ["Without Layout" => 504, "With Layout" => 604, "With Layout + Rush Print" => 654],
        "2x15" => ["Without Layout" => 540, "With Layout" => 640, "With Layout + Rush Print" => 690],
        "2x16" => ["Without Layout" => 576, "With Layout" => 676, "With Layout + Rush Print" => 726],
        "2x17" => ["Without Layout" => 612, "With Layout" => 712, "With Layout + Rush Print" => 762],
        "2x18" => ["Without Layout" => 648, "With Layout" => 748, "With Layout + Rush Print" => 798],
        "2x19" => ["Without Layout" => 684, "With Layout" => 784, "With Layout + Rush Print" => 834],
        "2x20" => ["Without Layout" => 720, "With Layout" => 820, "With Layout + Rush Print" => 870],
        "2x21" => ["Without Layout" => 756, "With Layout" => 856, "With Layout + Rush Print" => 906],
        "2x22" => ["Without Layout" => 792, "With Layout" => 892, "With Layout + Rush Print" => 942],
        "3x3" => ["Without Layout" => 162, "With Layout" => 262, "With Layout + Rush Print" => 312],
        "3x4" => ["Without Layout" => 216, "With Layout" => 316, "With Layout + Rush Print" => 366],
        "3x5" => ["Without Layout" => 270, "With Layout" => 370, "With Layout + Rush Print" => 420],
        "3x6" => ["Without Layout" => 324, "With Layout" => 424, "With Layout + Rush Print" => 474],
        "3x7" => ["Without Layout" => 378, "With Layout" => 478, "With Layout + Rush Print" => 528],
        "3x8" => ["Without Layout" => 432, "With Layout" => 532, "With Layout + Rush Print" => 582],
        "3x9" => ["Without Layout" => 486, "With Layout" => 586, "With Layout + Rush Print" => 636],
        "3x10" => ["Without Layout" => 540, "With Layout" => 640, "With Layout + Rush Print" => 690],
        "3x11" => ["Without Layout" => 594, "With Layout" => 694, "With Layout + Rush Print" => 744],
        "3x12" => ["Without Layout" => 648, "With Layout" => 748, "With Layout + Rush Print" => 798],
        "3x13" => ["Without Layout" => 702, "With Layout" => 802, "With Layout + Rush Print" => 852],
        "3x14" => ["Without Layout" => 756, "With Layout" => 856, "With Layout + Rush Print" => 906],
        "3x15" => ["Without Layout" => 810, "With Layout" => 910, "With Layout + Rush Print" => 960],
        "3x16" => ["Without Layout" => 864, "With Layout" => 964, "With Layout + Rush Print" => 1014],
        "3x17" => ["Without Layout" => 918, "With Layout" => 1018, "With Layout + Rush Print" => 1068],
        "3x18" => ["Without Layout" => 972, "With Layout" => 1072, "With Layout + Rush Print" => 1122],
        "3x19" => ["Without Layout" => 1026, "With Layout" => 1126, "With Layout + Rush Print" => 1176],
        "3x20" => ["Without Layout" => 1080, "With Layout" => 1180, "With Layout + Rush Print" => 1230],
        "3x21" => ["Without Layout" => 1134, "With Layout" => 1234, "With Layout + Rush Print" => 1284],
        "3x22" => ["Without Layout" => 1188, "With Layout" => 1288, "With Layout + Rush Print" => 1338],
        "4x2" => ["Without Layout" => 144, "With Layout" => 244, "With Layout + Rush Print" => 294],
        "4x3" => ["Without Layout" => 216, "With Layout" => 316, "With Layout + Rush Print" => 366],
        "4x4" => ["Without Layout" => 288, "With Layout" => 388, "With Layout + Rush Print" => 438],
        "4x5" => ["Without Layout" => 360, "With Layout" => 460, "With Layout + Rush Print" => 510],
        "4x6" => ["Without Layout" => 432, "With Layout" => 532, "With Layout + Rush Print" => 582],
        "4x7" => ["Without Layout" => 504, "With Layout" => 604, "With Layout + Rush Print" => 654],
        "4x8" => ["Without Layout" => 576, "With Layout" => 676, "With Layout + Rush Print" => 726],
        "4x9" => ["Without Layout" => 648, "With Layout" => 748, "With Layout + Rush Print" => 798],
        "4x10" => ["Without Layout" => 720, "With Layout" => 820, "With Layout + Rush Print" => 870],
        "4x11" => ["Without Layout" => 792, "With Layout" => 892, "With Layout + Rush Print" => 942],
        "4x12" => ["Without Layout" => 864, "With Layout" => 964, "With Layout + Rush Print" => 1014],
        "4x13" => ["Without Layout" => 936, "With Layout" => 1036, "With Layout + Rush Print" => 1086],
        "4x14" => ["Without Layout" => 1008, "With Layout" => 1108, "With Layout + Rush Print" => 1158],
        "4x15" => ["Without Layout" => 1080, "With Layout" => 1180, "With Layout + Rush Print" => 1230],
        "4x16" => ["Without Layout" => 1152, "With Layout" => 1252, "With Layout + Rush Print" => 1302],
        "4x17" => ["Without Layout" => 1224, "With Layout" => 1324, "With Layout + Rush Print" => 1374],
        "4x18" => ["Without Layout" => 1296, "With Layout" => 1396, "With Layout + Rush Print" => 1446],
        "4x19" => ["Without Layout" => 1368, "With Layout" => 1468, "With Layout + Rush Print" => 1518],
        "4x20" => ["Without Layout" => 1440, "With Layout" => 1540, "With Layout + Rush Print" => 1590],
        "4x21" => ["Without Layout" => 1512, "With Layout" => 1612, "With Layout + Rush Print" => 1662],
        "5x2" => ["Without Layout" => 180, "With Layout" => 280, "With Layout + Rush Print" => 330],
        "5x3" => ["Without Layout" => 270, "With Layout" => 370, "With Layout + Rush Print" => 420],
        "5x4" => ["Without Layout" => 360, "With Layout" => 460, "With Layout + Rush Print" => 510],
        "5x5" => ["Without Layout" => 450, "With Layout" => 550, "With Layout + Rush Print" => 600],
        "5x6" => ["Without Layout" => 540, "With Layout" => 640, "With Layout + Rush Print" => 690],
        "5x7" => ["Without Layout" => 630, "With Layout" => 730, "With Layout + Rush Print" => 780],
        "5x8" => ["Without Layout" => 720, "With Layout" => 820, "With Layout + Rush Print" => 870],
        "5x9" => ["Without Layout" => 810, "With Layout" => 910, "With Layout + Rush Print" => 960],
        "5x10" => ["Without Layout" => 900, "With Layout" => 1000, "With Layout + Rush Print" => 1050],
        "5x11" => ["Without Layout" => 990, "With Layout" => 1090, "With Layout + Rush Print" => 1140],
        "5x12" => ["Without Layout" => 1080, "With Layout" => 1180, "With Layout + Rush Print" => 1230],
        "5x13" => ["Without Layout" => 1170, "With Layout" => 1270, "With Layout + Rush Print" => 1320],
        "5x14" => ["Without Layout" => 1260, "With Layout" => 1360, "With Layout + Rush Print" => 1410],
        "5x15" => ["Without Layout" => 1350, "With Layout" => 1450, "With Layout + Rush Print" => 1500],
        "5x16" => ["Without Layout" => 1440, "With Layout" => 1540, "With Layout + Rush Print" => 1590],
        "5x17" => ["Without Layout" => 1530, "With Layout" => 1630, "With Layout + Rush Print" => 1680],
        "5x18" => ["Without Layout" => 1620, "With Layout" => 1720, "With Layout + Rush Print" => 1770],
        "5x19" => ["Without Layout" => 1710, "With Layout" => 1810, "With Layout + Rush Print" => 1860],
        "5x20" => ["Without Layout" => 1800, "With Layout" => 1900, "With Layout + Rush Print" => 1950],
        "5x21" => ["Without Layout" => 1890, "With Layout" => 1990, "With Layout + Rush Print" => 2040]
    ];

    // Extracting first word and last two words from printingDetail
    $printingDetailArray = explode(" ", $printingDetail);
    $printingDetailShort = $printingDetailArray[0] . " " . end($printingDetailArray) . " " . prev($printingDetailArray);

    // Check if the quantity ordered exceeds the available quantity in ktees_inventory
    $stmt_check = $conn->prepare("SELECT xs, s, m, l, xl, xxl, xxxl, xxxxl FROM ktees_inventoryshirt WHERE printingDetail = ?"); 
    $stmt_check->bind_param("s", $printingDetail);
    $stmt_check->execute();
    $stmt_check->bind_result($available_xs, $available_s, $available_m, $available_l, $available_xl, $available_xxl, $available_xxxl, $available_xxxxl);
    $stmt_check->fetch();
    $stmt_check->close();

    $out_of_stock_sizes = [];

    if ($xs > $available_xs) {
        $out_of_stock_sizes[] = "Extra Small";
    }
    if ($s > $available_s) {
        $out_of_stock_sizes[] = "Small";
    }
    if ($m > $available_m) {
        $out_of_stock_sizes[] = "Medium";
    }
    if ($l > $available_l) {
        $out_of_stock_sizes[] = "Large";
    }
    if ($xl > $available_xl) {
        $out_of_stock_sizes[] = "Extra Large";
    }
    if ($xxl > $available_xxl) {
        $out_of_stock_sizes[] = "XXL";
    }
    if ($xxxl > $available_xxxl) {
        $out_of_stock_sizes[] = "XXXL";
    }
    if ($xxxxl > $available_xxxxl) {
        $out_of_stock_sizes[] = "XXXXL";
    }

    if (!empty($out_of_stock_sizes)) {
        $out_of_stock_message = "The following size(s) are out of stock for: <br> <strong> $printingDetailShort - " . implode(", ", $out_of_stock_sizes) . "</strong>";

        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Can\'t Add Order',
                html: '$out_of_stock_message',
            }).then(() => {
                window.location.href = '../order/';
            });
        </script>";
        exit;
    }

    // Calculate product price based on sizes
    $productPrice_xs = 0;
    $productPrice_s = 0; 
    $productPrice_m = 0;
    $productPrice_l = 0; 
    $productPrice_xl = 0; 
    $productPrice_xxl = 0; 
    $productPrice_xxxl = 0; 
    $productPrice_xxxxl = 0;

    if ($printingDetail == "T-shirt with Print Dryfit White") {
        $productPrice_xs = 180 * $xs;
        $productPrice_s = 160 * $s;
        $productPrice_m = 170 * $m;
        $productPrice_l = 200 * $l;
        $productPrice_xl = 215 * $xl;
        $productPrice_xxl = 235 * $xxl;
        $productPrice_xxxl = 260 * $xxxl;
        $productPrice_xxxxl = 290 * $xxxxl;
    } elseif ($printingDetail == "T-shirt with Print Dryfit Colored") {
        $productPrice_xs = 180 * $xs;
        $productPrice_s = 190 * $s;
        $productPrice_m = 200 * $m;
        $productPrice_l = 230 * $l;
        $productPrice_xl = 245 * $xl;
        $productPrice_xxl = 265 * $xxl;
        $productPrice_xxxl = 290 * $xxxl;
        $productPrice_xxxxl = 320 * $xxxxl;
    } elseif ($printingDetail == "T-shirt with Print Cotton White") {
        $productPrice_xs = 190 * $xs;
        $productPrice_s = 200 * $s;
        $productPrice_m = 240 * $m;
        $productPrice_l = 250 * $l;
        $productPrice_xl = 265 * $xl;
        $productPrice_xxl = 285 * $xxl;
        $productPrice_xxxl = 310 * $xxxl;
        $productPrice_xxxxl = 340 * $xxxxl;
    } elseif ($printingDetail == "T-shirt with Print Cotton Colored") {
        $productPrice_xs = 200 * $xs;
        $productPrice_s = 230 * $s;
        $productPrice_m = 250 * $m;
        $productPrice_l = 260 * $l;
        $productPrice_xl = 275 * $xl;
        $productPrice_xxl = 290 * $xxl;
        $productPrice_xxxl = 315 * $xxxl;
        $productPrice_xxxxl = 345 * $xxxxl;
    } elseif ($printingDetail == "Poloshirt with print Dryfit White") {
        $productPrice_xs = 180 * $xs;
        $productPrice_s = 250 * $s;
        $productPrice_m = 300 * $m;
        $productPrice_l = 350 * $l;
        $productPrice_xl = 365 * $xl;
        $productPrice_xxl = 385 * $xxl;
        $productPrice_xxxl = 410 * $xxxl;
        $productPrice_xxxxl = 440 * $xxxxl;
    } elseif ($printingDetail == "Poloshirt with print Dryfit Colored") {
        $productPrice_xs = 280 * $xs;
        $productPrice_s = 300 * $s;
        $productPrice_m = 350 * $m;
        $productPrice_l = 450 * $l;
        $productPrice_xl = 465 * $xl;
        $productPrice_xxl = 485 * $xxl;
        $productPrice_xxxl = 510 * $xxxl;
        $productPrice_xxxxl = 540 * $xxxxl;
    } elseif ($printingDetail == "Poloshirt with print Cotton White") {
        $productPrice_xs = 180 * $xs;
        $productPrice_s = 290 * $s;
        $productPrice_m = 340 * $m;
        $productPrice_l = 360 * $l;
        $productPrice_xl = 375 * $xl;
        $productPrice_xxl = 395 * $xxl;
        $productPrice_xxxl = 420 * $xxxl;
        $productPrice_xxxxl = 450 * $xxxxl;
    } elseif ($printingDetail == "Poloshirt with print Cotton Colored") {
        $productPrice_xs = 180 * $xs;
        $productPrice_s = 300 * $s;
        $productPrice_m = 350 * $m;
        $productPrice_l = 400 * $l;
        $productPrice_xl = 415 * $xl;
        $productPrice_xxl = 435 * $xxl;
        $productPrice_xxxl = 460 * $xxxl;
        $productPrice_xxxxl = 490 * $xxxxl;
    }

    // Check if the quantity ordered exceeds the available quantity of mugs in ktees_inventory
    $stmt_check_mug = $conn->prepare("SELECT mugQuantity FROM ktees_inventoryotherproduct ORDER BY id ASC LIMIT 1"); 
    $stmt_check_mug->execute();
    $stmt_check_mug->bind_result($availableMugQuantity);
    $stmt_check_mug->fetch();
    $stmt_check_mug->close();

    if ($mugQuantity > $availableMugQuantity) {
        $messagePromptMug = "The requested quantity of mugs exceeds the available stock.";

        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Can\'t Add Order',
                html: '$messagePromptMug',
            }).then(() => {
                window.location.href = '../order/';
            });
        </script>";
        exit;
    }
    //Calculate Tshirt sizes price
    $productPrice = $productPrice_xs + $productPrice_s + $productPrice_m + $productPrice_l + $productPrice_xl + $productPrice_xxl + $productPrice_xxxl + $productPrice_xxxxl;

    $cost = 0;
    if ($tarpSize != "" && $tarpLayout != "") {
        $cost = $tarpaulinPrices[$tarpSize][$tarpLayout] * $commonQuantity;
    }

    $productIdCost = 0;
    if ($productId != "") {
        $productIdCost = $customerIdPrice[$productId] * $commonQuantity;
    }

    $plateNumberCost = 0;
    if ($platenumPrice != "") {
        $plateNumberCost = $plateNumberPrice[$platenumPrice] * $commonQuantity;
    }

    $mugPrintingCost = 0;
    if ($mugprice != "") {
        $mugPrintingCost = $mugPrintingPrice[$mugprice] * $mugQuantity;
    }

    $promoPrice = $platenumPrice . $mugprice;

    //Total Price of all products
    $totalPrice = $productPrice + $cost + $productIdCost + $plateNumberCost + $mugPrintingCost;
    // Format total price
    $formattedTotalPrice = number_format($totalPrice, 2, '.', ',');
    
    // Calculate total quantity
    $quantity = $xs + $s + $m + $l + $xl + $xxl + $xxxl + $xxxxl + $mugQuantity + $commonQuantity;

    // Deduct Mug quantity from ktees_inventory
    $id = 1; // Replace with the actual ID you need to use
    $stmt_mug_inventory = $conn->prepare("UPDATE ktees_inventoryotherproduct SET mugQuantity = mugQuantity - ? WHERE id = ?");
    $stmt_mug_inventory->bind_param('ii', $mugQuantity, $id);
    $stmt_mug_inventory->execute();
    $stmt_mug_inventory->close();


    // Deduct quantity from ktees_inventory
    $stmt_inventory = $conn->prepare("UPDATE ktees_inventoryshirt SET xs = xs - ?, s = s - ?, m = m - ?, l = l - ?, xl = xl - ?, xxl = xxl - ?, xxxl = xxxl - ?, xxxxl = xxxxl - ? WHERE printingDetail = ?"); 
    $stmt_inventory->bind_param("iiiiiiiis", $xs, $s, $m, $l, $xl, $xxl, $xxxl, $xxxxl, $printingDetail);
    $stmt_inventory->execute();
    $stmt_inventory->close();

    // Insert into ktees_sales table
    $stmt_sales = $conn->prepare("INSERT INTO ktees_product_sale (date_ordered, productPrice, payment, product) VALUES (?, ?, ?, ?)");
    $stmt_sales->bind_param("ssss", $dateOrdered, $formattedTotalPrice, $addpayment, $order);
    $stmt_sales->execute();
    $stmt_sales->close();

// Set the timezone to Pacific Standard Time (GMT+8)
    date_default_timezone_set('Asia/Manila'); // Manila is in the GMT+8 timezone
    // Timestamp for transact
    $currentTime = date('H:i:s'); // For timeTransact

    // Insert into ktees_transact history
    $stmt_sales = $conn->prepare("INSERT INTO ktees_transact_history (productOrder, dateTransact, staffName, timeTransact) VALUES (?, ?, ?, ?)");
    $stmt_sales->bind_param("ssss", $order, $dateOrdered, $staffName, $currentTime);
    $stmt_sales->execute();
    $stmt_sales->close();

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO ktees_order (client, type_order, payment, customerId, plate_number, productPromo, tarp_size, tarpLayout, type_print, printingDetail, x_small, small, medium, large, x_large, xx_large, xxx_large, xxxx_large, quantity, date_ordered, staff, due_date, order_status, productPrice) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssssssssssss", $client_name, $order, $addpayment, $productId, $platNum, $promoPrice, $tarpSize, $tarpLayout, $printEmbro, $printingDetail, $xs, $s, $m, $l, $xl, $xxl, $xxxl, $xxxxl, $quantity, $dateOrdered, $staffName, $deadline, $orderStatus, $formattedTotalPrice);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'New Order created successfully',
                }).then(() => {
                window.location.href = '../order/';
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
