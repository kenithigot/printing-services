<?php
// Include database connection
include('../authentication.php');

if(isset($_POST["saveOrder"])){
    // Sanitize inputs to prevent SQL injection
    $client_name = mysqli_real_escape_string($conn, $_POST["clientName"]);
    $order = mysqli_real_escape_string($conn, $_POST["add-order"]);
    $platNum = isset($_POST["plate_number"]) ? mysqli_real_escape_string($conn, $_POST["plate_number"]) : "";
    $tarpSize = isset($_POST["tarpaulinSize"]) ? mysqli_real_escape_string($conn, $_POST["tarpaulinSize"]) : "";
    $printEmbro = isset($_POST["typePrintEmbro"]) ? mysqli_real_escape_string($conn, $_POST["typePrintEmbro"]) : "";
    $shirt = isset($_POST["typeShirt"]) ? mysqli_real_escape_string($conn, $_POST["typeShirt"]) : "";
    $cloth = isset($_POST["typeCloth"]) ? mysqli_real_escape_string($conn, $_POST["typeCloth"]) : "";
    $typeShirtOther = isset($_POST["typeShirtOther"]) ? mysqli_real_escape_string($conn, $_POST["typeShirtOther"]) : "";
    $xs = (int) mysqli_real_escape_string($conn, $_POST["xsmall"]);
    $s = (int) mysqli_real_escape_string($conn, $_POST["small"]);
    $m = (int) mysqli_real_escape_string($conn, $_POST["medium"]);
    $l = (int) mysqli_real_escape_string($conn, $_POST["large"]);
    $xl = (int) mysqli_real_escape_string($conn, $_POST["xlarge"]);
    $xxl = (int) mysqli_real_escape_string($conn, $_POST["2xlarge"]);
    $xxxl = (int) mysqli_real_escape_string($conn, $_POST["3xlarge"]);
    $xxxxl = (int) mysqli_real_escape_string($conn, $_POST["4xlarge"]);
    $commonQuantity = (int) mysqli_real_escape_string($conn, $_POST["commonQuantity"]);
    $dateOrdered = mysqli_real_escape_string($conn, $_POST["add-dateOrdered"]);
    $staffName = mysqli_real_escape_string($conn, $_POST["add-staffName"]);
    $deadline = mysqli_real_escape_string($conn, $_POST["add-dateDeadline"]);
    $orderStatus = mysqli_real_escape_string($conn, $_POST["add-orderStatus"]);

    // Check if the quantity ordered exceeds the available quantity in ktees_inventory
    $stmt_check = $conn->prepare("SELECT xs, s, m, l, xl, xxl, xxxl, xxxxl FROM ktees_inventory WHERE id = 1"); 
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
        $out_of_stock_message = "The following size(s) are out of stock: <br><strong>" . implode(", ", $out_of_stock_sizes) . "</strong>";

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

    // Calculate total quantity
    $quantity = $xs + $s + $m + $l + $xl + $xxl + $xxxl + $xxxxl + $commonQuantity;

    // Deduct quantity from ktees_inventory
    $stmt_inventory = $conn->prepare("UPDATE ktees_inventory SET xs = xs - ?, s = s - ?, m = m - ?, l = l - ?, xl = xl - ?, xxl = xxl - ?, xxxl = xxxl - ?, xxxxl = xxxxl - ? WHERE id = 1"); // Assuming id 1 is the relevant row in ktees_inventory
    $stmt_inventory->bind_param("iiiiiiii", $xs, $s, $m, $l, $xl, $xxl, $xxxl, $xxxxl);
    $stmt_inventory->execute();
    $stmt_inventory->close();

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO ktees_order (client, type_order, plate_number, tarp_size, type_print, type_tshirt, type_cloth, x_small, small, medium, large, x_large, xx_large, xxx_large, xxxx_large, quantity, date_ordered, staff, due_date, order_status, typeShirtOther) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssssssss", $client_name, $order, $platNum, $tarpSize, $printEmbro, $shirt, $cloth, $xs, $s, $m, $l, $xl, $xxl, $xxxl, $xxxxl, $quantity, $dateOrdered, $staffName, $deadline, $orderStatus, $typeShirtOther);

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
