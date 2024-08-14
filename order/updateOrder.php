<?php
// Include necessary files
include('../authentication.php');

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $edittarpaulinSize = isset($_POST["edittarpaulinSize"]) ? mysqli_real_escape_string($conn, $_POST["edittarpaulinSize"]) : "";
    $editlayoutTarp = isset($_POST["editlayoutTarp"]) ? mysqli_real_escape_string($conn, $_POST["editlayoutTarp"]) : "";
    $commonQuantityUnit = $_POST['editcommonQuantity'];
    $mugQuantity = $_POST['editmugQuantity'];
    $editmugprice = isset($_POST['editmugprice']) ? $_POST['editmugprice'] : '';
    $printingDetail = isset($_POST['editprintingDetail']) ? $_POST['editprintingDetail'] : '';
    $xs = isset($_POST['editxsmall']) ? (int)$_POST['editxsmall'] : 0;
    $s = isset($_POST['editsmall']) ? (int)$_POST['editsmall'] : 0;
    $m = isset($_POST['editmedium']) ? (int)$_POST['editmedium'] : 0;
    $l = isset($_POST['editlarge']) ? (int)$_POST['editlarge'] : 0;
    $xl = isset($_POST['editxlarge']) ? (int)$_POST['editxlarge'] : 0;
    $xxl = isset($_POST['edit2xlarge']) ? (int)$_POST['edit2xlarge'] : 0;
    $xxxl = isset($_POST['edit3xlarge']) ? (int)$_POST['edit3xlarge'] : 0;
    $xxxxl = isset($_POST['edit4xlarge']) ? (int)$_POST['edit4xlarge'] : 0;
    $platenumPrice = isset($_POST["editplatenumPrice"]) ? mysqli_real_escape_string($conn, $_POST["editplatenumPrice"]) : "";
    $editproductId = isset($_POST["editproductId"]) ? mysqli_real_escape_string($conn, $_POST["editproductId"]) : "";

    // Get the old quantities from the database
    $stmt_old = $conn->prepare("SELECT x_small, small, medium, large, x_large, xx_large, xxx_large, xxxx_large, quantity FROM ktees_order WHERE id = ?");
    $stmt_old->bind_param("i", $id);
    $stmt_old->execute();
    $stmt_old->bind_result($old_xs, $old_s, $old_m, $old_l, $old_xl, $old_xxl, $old_xxxl, $old_xxxxl, $oldmugQuantity);
    $stmt_old->fetch();
    $stmt_old->close();

    $diff_xs = 0;
    $diff_s = 0;
    $diff_m = 0;
    $diff_l = 0;
    $diff_xl = 0;
    $diff_xxl = 0;
    $diff_xxxl = 0;
    $diff_xxxxl = 0;
    $diff_mug = 0;

    // Calculate the difference between old and new quantities
    $diff_xs = $xs - $old_xs;
    $diff_s = $s - $old_s;
    $diff_m = $m - $old_m;
    $diff_l = $l - $old_l;
    $diff_xl = $xl - $old_xl;
    $diff_xxl = $xxl - $old_xxl;
    $diff_xxxl = $xxxl - $old_xxxl;
    $diff_xxxxl = $xxxxl - $old_xxxxl;
    $diff_mug = $mugQuantity - $oldmugQuantity;

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

    // Calculate product price based on sizes and printing details
    $productPrices = [
        "T-shirt with Print Dryfit White" => [160, 160, 170, 200, 215, 235, 260, 290],
        "T-shirt with Print Dryfit Colored" => [180, 190, 200, 230, 245, 265, 290, 320],
        "T-shirt with Print Cotton White" => [190, 200, 240, 250, 265, 285, 310, 340],
        "T-shirt with Print Cotton Colored" => [200, 230, 250, 260, 275, 290, 315, 345],
        "Poloshirt with print Dryfit White" => [0, 250, 300, 350, 365, 385, 410, 440],
        "Poloshirt with print Dryfit Colored" => [280, 300, 350, 450, 465, 485, 510, 540],
        "Poloshirt with print Cotton White" => [0, 290, 340, 360, 375, 395, 420, 450],
        "Poloshirt with print Cotton Colored" => [0, 300, 350, 400, 415, 435, 460, 490]
    ];

    //Plate Number promo price
    $plateNumberPrice = ["Promo" => [250], "Regular" => [300]];

    //Mug Printing promo price
    $mugPrintingPrice = ["Promo Offer" => [100], "Regular Offer" => [150]];

    // Customer ID price
    $customerIdPrice = ["School ID" => [90], "Barangay ID" => [250], "Walk-In ID" => [100]];

    //Tshirt Printing Computation
    $productPriceprint = 0;
    if (isset($productPrices[$printingDetail])) {
        $prices = $productPrices[$printingDetail];
        $productPriceprint = $prices[0] * $xs + $prices[1] * $s + $prices[2] * $m + $prices[3] * $l + $prices[4] * $xl + $prices[5] * $xxl + $prices[6] * $xxxl + $prices[7] * $xxxxl;
    }

    // Extracting first word and last two words from printingDetail
    $printingDetailArray = explode(" ", $printingDetail);
    $printingDetailShort = $printingDetailArray[0] . " " . end($printingDetailArray) . " " . prev($printingDetailArray);

    //Tarpaulin Computation
    $cost = 0;
    if ($edittarpaulinSize != "" && $editlayoutTarp != "") {
        $cost = $tarpaulinPrices[$edittarpaulinSize][$editlayoutTarp] * $commonQuantityUnit;
    }

    //Plate Number Computation
    $plateNumberCost = 0;
    if (array_key_exists($platenumPrice, $plateNumberPrice)){
        $platNumPrices = $plateNumberPrice[$platenumPrice];
        $plateNumberCost = $platNumPrices[0] * $commonQuantityUnit;
    }

    //Mug Printing Computation
    $mugPrintingCost = 0;
    if (array_key_exists($editmugprice, $mugPrintingPrice)){
        $mugPrices = $mugPrintingPrice[$editmugprice];
        $mugPrintingCost = $mugPrices[0] * $mugQuantity;
    }

    //Id Printing Computation
    $idPrintingCost = 0;
    if (array_key_exists($editproductId, $customerIdPrice)){
        $idPricePrices = $customerIdPrice[$editproductId];
        $idPrintingCost = $idPricePrices[0] * $commonQuantityUnit;
    }

    //Determine the updated value for productPromoPrice
    $productPromoPrice = '';
    if (!empty($editmugprice) && array_key_exists($editmugprice, $mugPrintingPrice)) {
        $productPromoPrice = $editmugprice;
    } elseif (!empty($platenumPrice) && array_key_exists($platenumPrice, $plateNumberPrice)) {
        $productPromoPrice = $platenumPrice;
    }
    
    $productTypeCost = $productPriceprint + $cost + $plateNumberCost + $mugPrintingCost + $idPrintingCost;
    // Format the product price
    $productPrice = number_format($productTypeCost, 2, '.', ',');
    // Calculate total quantity based on sizes
    $total_quantity = $diff_xs + $diff_s + $diff_m + $diff_l + $diff_xl + $diff_xxl + $diff_xxxl + $diff_xxxxl + $commonQuantityUnit + $diff_mug;

    // Check if the quantity ordered exceeds the available quantity in ktees_inventory
    if ($xs > 0 || $s > 0 || $m > 0 || $l > 0 || $xl > 0 || $xxl > 0 || $xxxl > 0 || $xxxxl > 0) {
        $stmt_check = $conn->prepare("SELECT xs, s, m, l, xl, xxl, xxxl, xxxxl FROM ktees_inventoryshirt WHERE printingDetail = ?");
        $stmt_check->bind_param("s", $printingDetail);
        $stmt_check->execute();
        $stmt_check->bind_result($available_xs, $available_s, $available_m, $available_l, $available_xl, $available_xxl, $available_xxxl, $available_xxxxl);
        $stmt_check->fetch();
        $stmt_check->close();

        $out_of_stock_sizes = [];

        if ($xs > $available_xs) $out_of_stock_sizes[] = "Extra Small";
        if ($s > $available_s) $out_of_stock_sizes[] = "Small";
        if ($m > $available_m) $out_of_stock_sizes[] = "Medium";
        if ($l > $available_l) $out_of_stock_sizes[] = "Large";
        if ($xl > $available_xl) $out_of_stock_sizes[] = "Extra Large";
        if ($xxl > $available_xxl) $out_of_stock_sizes[] = "XXL";
        if ($xxxl > $available_xxxl) $out_of_stock_sizes[] = "XXXL";
        if ($xxxxl > $available_xxxxl) $out_of_stock_sizes[] = "XXXXL";

        if (!empty($out_of_stock_sizes)) {
            $out_of_stock_message = "The following size(s) are out of stock for: <br> <strong> $printingDetailShort - " . implode(", ", $out_of_stock_sizes) . "</strong>";
            header('Content-Type: application/json');
            echo json_encode(['message' => $out_of_stock_message]);
            exit;
        }
    }

    
    // Check if the quantity ordered exceeds the available quantity of mugs
    $stmt_check_mug = $conn->prepare("SELECT mugQuantity FROM ktees_inventoryotherproduct ORDER BY id ASC LIMIT 1"); 
    $stmt_check_mug->execute();
    $stmt_check_mug->bind_result($availableMugQuantity);
    $stmt_check_mug->fetch();
    $stmt_check_mug->close();

    if($mugQuantity > $availableMugQuantity){
        if(!empty($availableMugQuantity)){
            $messagePromptMug = "The requested quantity of mugs exceeds the available stock.";
            header('Content-Type: application/json');
            echo json_encode(['message' => $messagePromptMug]);
            exit;
        }
    }    
    
    

    // Update the order
    $stmt = $conn->prepare("UPDATE ktees_order SET 
    client = ?, 
    type_order = ?, 
    type_print = ?, 
    printingDetail = ?,
    x_small = ?, 
    small = ?, 
    medium = ?, 
    large = ?, 
    x_large = ?, 
    xx_large = ?, 
    xxx_large = ?, 
    xxxx_large = ?, 
    quantity = ?, 
    tarp_size = ?, 
    plate_number = ?, 
    date_ordered = ?, 
    due_date = ?, 
    staff = ?, 
    order_status = ?, 
    productPrice = ?,
    tarp_size = ?, 
    tarpLayout = ?,
    productPromo = ?,
    customerId = ?,
    payment = ?
    WHERE id = ?");

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssssssssssssssssssssssi", 
    $_POST['editclientName'], 
    $_POST['editorder'], 
    $_POST['edittypePrintEmbro'], 
    $_POST['editprintingDetail'], 
    $_POST['editxsmall'], 
    $_POST['editsmall'], 
    $_POST['editmedium'], 
    $_POST['editlarge'], 
    $_POST['editxlarge'], 
    $_POST['edit2xlarge'], 
    $_POST['edit3xlarge'], 
    $_POST['edit4xlarge'], 
    $total_quantity,
    $_POST['edittarpaulinSize'], 
    $_POST['editplate_number'], 
    $_POST['editdateOrdered'], 
    $_POST['editdateDeadline'], 
    $_POST['editstaffName'], 
    $_POST['editorderStatus'], 
    $productPrice,
    $_POST["edittarpaulinSize"],
    $_POST["editlayoutTarp"],
    $productPromoPrice,
    $_POST['editproductId'],
    $_POST['editpayment'],
    $id);

    // Execute the prepared statement
    if ($stmt->execute()) {

        // Check if it's a Mug Printing order
        if (strtolower($printingDetail)) {
            // Update inventory for only the differences in quantities
            if ($diff_xs != 0 || $diff_s != 0 || $diff_m != 0 || $diff_l != 0 || $diff_xl != 0 || $diff_xxl != 0 || $diff_xxxl != 0 || $diff_xxxxl != 0) {
                $stmt_inventory = $conn->prepare("UPDATE ktees_inventoryshirt SET 
                    xs = xs - ?, 
                    s = s - ?, 
                    m = m - ?, 
                    l = l - ?, 
                    xl = xl - ?, 
                    xxl = xxl - ?, 
                    xxxl = xxxl - ?, 
                    xxxxl = xxxxl - ? 
                    WHERE printingDetail = ?");

                // Bind parameters to the prepared statement
                $stmt_inventory->bind_param("iiiiiiiis", 
                    $diff_xs, 
                    $diff_s, 
                    $diff_m, 
                    $diff_l, 
                    $diff_xl, 
                    $diff_xxl, 
                    $diff_xxxl, 
                    $diff_xxxxl, 
                    $_POST['editprintingDetail']); // <- Change $printingDetail to $_POST['editprintingDetail']

                // Execute the prepared statement for inventory update
                $stmt_inventory->execute();

                // Close the prepared statement for inventory update
                $stmt_inventory->close();
                
            }
        }else{
            $orderIdMug = 1;

            // Restore the mugQuantity back to the inventory
            $stmt_mug_inventory = $conn->prepare("UPDATE ktees_inventoryotherproduct SET 
                mugQuantity = mugQuantity - ? 
                WHERE id = ?");
            $stmt_mug_inventory->bind_param('ii',
                $diff_mug, $orderIdMug);
            $stmt_mug_inventory->execute();
            $stmt_mug_inventory->close();
        }
        // Update the corresponding record in the ktees_product_sale table
        $stmt_sale = $conn->prepare("UPDATE ktees_product_sale SET 
            date_ordered = ?, 
            payment = ?, 
            productPrice = ?, 
            product = ?
            WHERE id = ?");

        // Bind parameters to the prepared statement
        $stmt_sale->bind_param("ssssi", 
            $_POST['editdateOrdered'], 
            $_POST['editpayment'], 
            $productPrice,
            $_POST['editorder'],  
            $id 
            );

         // Execute the prepared statement for inventory update
         $stmt_sale->execute();

        // Close the prepared statement for ktees_product_sale
        $stmt_sale->close();


        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    mysqli_close($conn);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
