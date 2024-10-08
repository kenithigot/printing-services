<?php
include('../authentication.php');

    if (isset($_POST['id'])) {
        $orderId = $_POST['id'];

        // Get order details
        $stmt_order = $conn->prepare("SELECT printingDetail, x_small, small, medium, large, x_large, xx_large, xxx_large, xxxx_large, quantity FROM ktees_order WHERE id = ?");
        $stmt_order->bind_param("i", $orderId);
        $stmt_order->execute();
        $stmt_order->bind_result($printingDetail, $xs, $s, $m, $l, $xl, $xxl, $xxxl, $xxxxl, $mugQuantity);
        $stmt_order->fetch();
        $stmt_order->close();

        // Check if it's a Mug Printing order
        if (strtolower($printingDetail)) {

            // Update inventory for T-Shirt Printing order types
            $stmt_inventory = $conn->prepare("UPDATE ktees_inventoryshirt SET xs = xs + ?, s = s + ?, m = m + ?, l = l + ?, xl = xl + ?, xxl = xxl + ?, xxxl = xxxl + ?, xxxxl = xxxxl + ? WHERE printingDetail = ?");
            $stmt_inventory->bind_param("iiiiiiiis", $xs, $s, $m, $l, $xl, $xxl, $xxxl, $xxxxl, $printingDetail);
            $stmt_inventory->execute();
            $stmt_inventory->close();
        } else {
            $orderIdMug = 1;

            // Restore the mugQuantity back to the inventory
            $stmt_mug_inventory = $conn->prepare("UPDATE ktees_inventoryotherproduct SET mugQuantity = mugQuantity + ? WHERE id = ?");
            $stmt_mug_inventory->bind_param('ii', $mugQuantity, $orderIdMug);
            $stmt_mug_inventory->execute();
            $stmt_mug_inventory->close();
        
        }

        // Delete order from the sale table
        $stmt_delete_sale = $conn->prepare("DELETE FROM ktees_product_sale WHERE id = ?");
        $stmt_delete_sale->bind_param("i", $orderId);
        $stmt_delete_sale->execute();
        $stmt_delete_sale->close();

        // Delete order from the order table
        $stmt_delete = $conn->prepare("DELETE FROM ktees_order WHERE id = ?");
        $stmt_delete->bind_param("i", $orderId);

        $response = ['success' => false];
        if ($stmt_delete->execute() === TRUE) {
            $response['success'] = true;
        }
        echo json_encode($response);

        $stmt_delete->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false]);
    }
?>
