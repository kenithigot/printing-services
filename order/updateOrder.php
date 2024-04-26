<?php
// Include necessary files
include('../authentication.php');

if (isset($_POST["id"])) {
    $id = $_POST["id"];

    // Check if the order type is "T-shirt Printing"
    if ($_POST['editorder'] == "T-shirt Printing") {
        // Calculate total quantity based on sizes
        $total_quantity = $_POST['editxsmall'] + $_POST['editsmall'] + $_POST['editmedium'] + $_POST['editlarge'] + $_POST['editxlarge'] + $_POST['edit2xlarge'] + $_POST['edit3xlarge'] + $_POST['edit4xlarge'];

        // Check if there is enough inventory for each size
        $stmt_check_inventory = $conn->prepare("SELECT xs, s, m, l, xl, xxl, xxxl, xxxxl FROM ktees_inventory");
        $stmt_check_inventory->execute();
        $result_inventory = $stmt_check_inventory->get_result()->fetch_assoc();

        $insufficient_sizes = [];
        if ($_POST['editxsmall'] > $result_inventory['xs']) {
            $insufficient_sizes[] = 'X-Small';
        }
        if ($_POST['editsmall'] > $result_inventory['s']) {
            $insufficient_sizes[] = 'Small';
        }
        if ($_POST['editmedium'] > $result_inventory['m']) {
            $insufficient_sizes[] = 'Medium';
        }
        if ($_POST['editlarge'] > $result_inventory['l']) {
            $insufficient_sizes[] = 'Large';
        }
        if ($_POST['editxlarge'] > $result_inventory['xl']) {
            $insufficient_sizes[] = 'X-Large';
        }
        if ($_POST['edit2xlarge'] > $result_inventory['xxl']) {
            $insufficient_sizes[] = '2X-Large';
        }
        if ($_POST['edit3xlarge'] > $result_inventory['xxxl']) {
            $insufficient_sizes[] = '3X-Large';
        }
        if ($_POST['edit4xlarge'] > $result_inventory['xxxxl']) {
            $insufficient_sizes[] = '4X-Large';
        }

        if (!empty($insufficient_sizes)) {
            $error_message = '<strong>' . implode(', ', $insufficient_sizes) . '</strong>';
            echo json_encode(['success' => false, 'error' => $error_message]);
            exit;
        }

        // Update inventory
        $stmt_inventory = $conn->prepare("UPDATE ktees_inventory SET 
            xs = xs - ?, 
            s = s - ?, 
            m = m - ?, 
            l = l - ?, 
            xl = xl - ?, 
            xxl = xxl - ?, 
            xxxl = xxxl - ?, 
            xxxxl = xxxxl - ?");

        // Bind parameters to the prepared statement
        $stmt_inventory->bind_param("iiiiiiii", 
            $_POST['editxsmall'], 
            $_POST['editsmall'], 
            $_POST['editmedium'], 
            $_POST['editlarge'], 
            $_POST['editxlarge'], 
            $_POST['edit2xlarge'], 
            $_POST['edit3xlarge'], 
            $_POST['edit4xlarge']);

        // Execute the prepared statement for inventory update
        $stmt_inventory->execute();

        // Close the prepared statement for inventory update
        $stmt_inventory->close();
    } else {
        $total_quantity = $_POST['editcommonQuantity'];
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE ktees_order SET 
        client = ?, 
        type_order = ?, 
        type_print = ?, 
        type_tshirt = ?, 
        typeShirtOther = ?, 
        type_cloth = ?, 
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
        order_status = ?
        WHERE id = ?");

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssssssssssssssssssi", 
        $_POST['editclientName'], 
        $_POST['editorder'], 
        $_POST['edittypePrintEmbro'], 
        $_POST['edittypeShirt'], 
        $_POST['edittypeShirtOther'], 
        $_POST['edittypeCloth'], 
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
        $id);

    // Execute the prepared statement
    if ($stmt->execute()) {
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
