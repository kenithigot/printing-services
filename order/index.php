<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order - Printing Services</title>

   <!-- Sidebar -->
   <?php include('../includes/sidebar.php'); ?>

    <!-- Navigation bar -->
    <?php include('../includes/topbar.php');?>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 Stylesheet -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">

    <!-- Bootstrap 5 Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Font Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <?php include('add_order.php');?>
    </head>

</head>
<body>
    <div class="content">
        <div class="container-now">
            <div class="contain">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active fs-4"><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item fs-4" aria-current="page">Order</li>    
                </ul>
                <div class="added-container">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#order-modal">Add Order</button>
                    <hr>
                    <table id="order-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order</th>                 
                                <th>Client</th>
                                <th>QTY</th>                          
                                <th>Product</th>
                                <th>Date Order</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    <!-- Add Order Modal -->
                    <div class="modal fade" id="order-modal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModalLabel">Add Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="clientName" class="form-label">Client:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Type client name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-order" class="form-label">Order:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="add-order" name="add-order" onchange="toggleInputs()">
                                                <option value="" selected disabled>Select Order</option>
                                                <option value="Plate Number">Plate Number</option>
                                                <option value="Tarpaulin">Tarpaulin</option>
                                                <option value="T-shirt Printing">T-shirt Printing</option>
                                                <option value="Fullsublimation">Fullsublimation</option>
                                                <option value="Sentra Board Standee">Sentra Board Standee </option>
                                                <option value="Mug printing">Mug printing</option>
                                                <option value="School ID">School ID</option>
                                                <option value="Sticker">Sticker</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" id="commonQuantityInput" style="display: none;">
                                            <label for="commonQuantity" class="form-label">Quantity:<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="commonQuantity" name="commonQuantity" placeholder="Type quantity">
                                        </div>
                                        <div class="mb-3" id="platenumberinput" style="display: none;">
                                            <label for="plate_number" class="form-label">Plate Number:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Type plate number">
                                        </div>
                                        <div class="mb-3" id="tarpaulinInput" style="display: none;">
                                            <label for="tarpaulinSize" class="form-label">Tarpaulin Size:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="tarpaulinSize" name="tarpaulinSize" placeholder="Type tarpaulin size">
                                        </div>
                                        <div id="tshirtPrintingInputs" style="display: none;">
                                            <div class="mb-3">
                                                <label for="typePrintEmbro" class="form-label">Type of Print/Embro:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="typePrintEmbro" name="typePrintEmbro">
                                                    <option value="" selected disabled>Select the type of Print/Embro</option>
                                                    <option value="Manual Screen Printing">Manual Screen Printing</option>
                                                    <option value="Digital Embroidery">Digital Embroidery</option>
                                                    <option value="Digital Print - DTF">Digital Print - DTF</option>
                                                    <option value="Digital Print - Vinyl">Digital Print - Vinyl</option>
                                                    <option value="Digital Print Sublimation">Digital Print Sublimation</option>
                                                    <option value="Full Sublimation">Full Sublimation</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="typeCloth" class="form-label">Type of Cloth:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="typeCloth" name="typeCloth">
                                                    <option value="" selected disabled>Type of Cloth</option>
                                                    <option value="Dryfit">Dryfit</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Cotton">Cotton</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="typeShirt" class="form-label">Type of Shirt:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="typeShirt" name="typeShirt" onchange="toggleOtherInput()">
                                                    <option value="" selected disabled>Select the type of Shirt</option>
                                                    <option value="Customized Full Sublimation">Customized Full Sublimation</option>
                                                    <option value="Jersey">Jersey</option>
                                                    <option value="T-Shirt">T-Shirt</option>
                                                    <option value="Polo Shirt">Polo Shirt</option>
                                                    <option value="V-Neck">V-Neck</option>
                                                    <option value="Long Sleeve">Long Sleeve</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-3" id="typeShirtOtherInput" style="display: none;">
                                                <label for="typeShirtOther" class="form-label">Applicable for Type of Shirt [Other]:<span style="color:red">&nbsp*</span></label>
                                                <input type="text" class="form-control" id="typeShirtOther" name="typeShirtOther">
                                            </div>

                                            <div class="mb-3">
                                                <label for="xsmall" class="form-label">Quantity ( Xs ) :<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="xsmall" name="xsmall" placeholder="Type quantity of Xs size" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="small" class="form-label">Quantity ( S ):<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="small" name="small" placeholder="Type quantity of S size">
                                            </div>
                                            <div class="mb-3">
                                                <label for="medium" class="form-label">Quantity ( M ):<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="medium" name="medium" placeholder="Type quantity of M size">
                                            </div>
                                            <div class="mb-3">
                                                <label for="large" class="form-label">Quantity ( L ):<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="large" name="large" placeholder="Type quantity of L size">
                                            </div>
                                            <div class="mb-3">
                                                <label for="xlarge" class="form-label">Quantity ( Xl ):<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="xlarge" name="xlarge" placeholder="Type quantity of XL size">
                                            </div>
                                            <div class="mb-3">
                                                <label for="2xlarge" class="form-label">Quantity ( 2Xl ):<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="2xlarge" name="2xlarge" placeholder="Type quantity of XXL size">
                                            </div>
                                            <div class="mb-3">
                                                <label for="3xlarge" class="form-label">Quantity ( 3Xl ):<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="3xlarge" name="3xlarge" placeholder="Type quantity of XXXL size">
                                            </div>
                                            <div class="mb-3">
                                                <label for="4xlarge" class="form-label">Quantity ( 4Xl ):<span style="color:red">&nbsp*</span></label>
                                                <input type="number" class="form-control" id="4xlarge" name="4xlarge" placeholder="Type quantity of XXXXL size">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-dateOrdered" class="form-label">Date Ordered:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="add-dateOrdered" name="add-dateOrdered" placeholder="Select Ordered Date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-staffName" class="form-label">Staff Name:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="add-staffName" name="add-staffName" required>
                                                <option value="" selected disabled>Select Staff</option>
                                                <option value="Kid Eumil T. Suco">Kid Eumil T. Suco</option>
                                                <option value="Emelda T. Suco">Emelda T. Suco</option>
                                                <option value="Leslie A. Suco">Leslie A. Suco</option>
                                                <option value="Rolannie R. Suco">Rolannie R. Suco</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-dateDeadline" class="form-label">Due Date:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="add-dateDeadline" name="add-dateDeadline" placeholder="Select Due Date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-orderStatus" class="form-label">Order Status:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="add-orderStatus" name="add-orderStatus" required>
                                                <option value="" selected disabled>Select Order Status</option>
                                                <option value="Not yet started">Not yet started</option>
                                                <option value="Started">Started</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="saveOrder">Add Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Add Order Modal -->

                    <!-- View Order Modal -->
                    <div class="modal fade bd-example-modal-xl" id="viewOrder-modal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewOrderModalLabel">View Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" class="id">
                                        <div class="form-inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-jobRole">Product:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-jobRole" name="view-jobRole"></label>
                                            </div>
                                            <br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-client">Client:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-client" name="view-client"></label>
                                            </div>
                                            <hr>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" style="text-decoration:underline">ORDER DETAILS<span style="color:red">*</span></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2" id="view-plate_number-label">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-plate_number">Plate Number:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-plate_number" name="view-plate_number"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2" id="view-tarpaulin-label">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-tarpaulin">Tarpaulin Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-tarpaulin" name="view-tarpaulin"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2" id="view-typePrintEmbro-label">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-typePrintEmbro">Type of Print/Embro:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-typePrintEmbro" name="view-typePrintEmbro"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2" id="view-typeShirt-label">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-typeShirt">Type of Shirt:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-typeShirt" name="view-typeShirt"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2" id="view-typeShirtOther-label">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-typeShirtOther">Type of Shirt[Other]:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-typeShirtOther" name="view-typeShirtOther"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2" id="view-typeCloth-label">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-typeCloth">Type of Cloth:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-typeCloth" name="view-typeCloth"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2 size-fields ">
                                                <label class="custom-control-label fs-5 px-2 fw-bold " for="view-size">T-Shirt Sizes<span style="color:red">*</span></label>
                                                <br>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-xssize" id="view-xssize-label">XS Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-xssize" name="view-xssize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-ssize" id="view-ssize-label">S Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-ssize" name="view-ssize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-msize" id="view-msize-label">M Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-msize" name="view-msize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-lsize" id="view-lsize-label">L Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-lsize" name="view-lsize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-xlsize" id="view-xlsize-label">XL Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-xlsize" name="view-xlsize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-xxlsize" id="view-xxlsize-label">XXL Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-xxlsize" name="view-xxlsize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-xxxlsize" id="view-xxxlsize-label">XXXL Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-xxxlsize" name="view-xxxlsize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-4 size-fields">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-xxxxlsize" id="view-xxxxlsize-label">XXXXL Size:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-xxxxlsize" name="view-xxxxlsize"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-quantity">Total Quantity:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-quantity" name="view-quantity"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-dateOrdered">Date Ordered:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-dateOrdered" name="view-dateOrdered"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-dueDate">Due Date:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-dueDate" name="view-dueDate"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-staff">Staff:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-staff" name="view-staff"></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline ms-2">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-orderStatus">Order Status:</label>
                                                <label class="custom-control-label fs-5 border-label" id="view-orderStatus" name="view-orderStatus"></label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of View Task Modal -->

                    <!-- Edit Order Modal -->
                    <div class="modal fade" id="editOrder-modal" tabindex="-1" aria-labelledby="orderEditModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderEditModalLabel">Edit Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="editclientName" class="form-label" id="editClientNameLabel">Client:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="editclientName" name="editclientName" placeholder="Type client name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editorder" class="form-label" id="editorderLabel">Order:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="editorder" name="editorder">
                                                <option value="" selected disabled>Select Order</option>
                                                <option value="Plate Number">Plate Number</option>
                                                <option value="Tarpaulin">Tarpaulin</option>
                                                <option value="T-shirt Printing">T-shirt Printing</option>
                                                <option value="Fullsublimation">Fullsublimation</option>
                                                <option value="Sentra Board Standee">Sentra Board Standee </option>
                                                <option value="Mug printing">Mug printing</option>
                                                <option value="School ID">School ID</option>
                                                <option value="Sticker">Sticker</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editcommonQuantity" class="form-label" id="editcommonQuantityLabel">Quantity:<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="editcommonQuantity" name="editcommonQuantity" placeholder="Type quantity">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editplate_number" class="form-label" id="editplate_numberLabel">Plate Number:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="editplate_number" name="editplate_number" placeholder="Type plate number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edittarpaulinSize" class="form-label" id="edittarpaulinSizeLabel">Tarpaulin Size:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="edittarpaulinSize" name="edittarpaulinSize" placeholder="Type tarpaulin size">
                                        </div>  
                                        <div class="mb-3">
                                            <label for="edittypePrintEmbro" class="form-label" id="edittypePrintEmbroLabel">Type of Print/Embro:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="edittypePrintEmbro" name="edittypePrintEmbro">
                                                <option value="" selected disabled>Select the type of Print/Embro</option>
                                                <option value="Manual Screen Printing">Manual Screen Printing</option>
                                                <option value="Digital Embroidery">Digital Embroidery</option>
                                                <option value="Digital Print - DTF">Digital Print - DTF</option>
                                                <option value="Digital Print - Vinyl">Digital Print - Vinyl</option>
                                                <option value="Digital Print Sublimation">Digital Print Sublimation</option>
                                                <option value="Full Sublimation">Full Sublimation</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edittypeCloth" class="form-label" id="edittypeClothLabel">Type of Cloth:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="edittypeCloth" name="edittypeCloth">
                                                <option value="" selected disabled>Type of Cloth</option>
                                                <option value="Dryfit">Dryfit</option>
                                                <option value="Active">Active</option>
                                                <option value="Cotton">Cotton</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edittypeShirt" class="form-label" id="edittypeShirtLabel">Type of Shirt:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="edittypeShirt" name="edittypeShirt">
                                                <option value="" selected disabled>Select the type of Shirt</option>
                                                <option value="Customized Full Sublimation">Customized Full Sublimation</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="T-Shirt">T-Shirt</option>
                                                <option value="Polo Shirt">Polo Shirt</option>
                                                <option value="V-Neck">V-Neck</option>
                                                <option value="Long Sleeve">Long Sleeve</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edittypeShirtOther" class="form-label" id="edittypeShirtOtherLabel">Applicable for Type of Shirt [Other]:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="edittypeShirtOther" name="edittypeShirtOther">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editxsmall" class="form-label" id="editxsmallLabel">Quantity ( Xs ) :<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="editxsmall" name="editxsmall" placeholder="Type quantity of Xs size" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="editsmall" class="form-label" id="editsmallLabel">Quantity ( S ):<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="editsmall" name="editsmall" placeholder="Type quantity of S size">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editmedium" class="form-label" id="editsmallLabel">Quantity ( M ):<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="editmedium" name="editmedium" placeholder="Type quantity of M size">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editlarge" class="form-label" id="editlargeLabel">Quantity ( L ):<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="editlarge" name="editlarge" placeholder="Type quantity of L size">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editxlarge" class="form-label" id="editxlargeLabel">Quantity ( Xl ):<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="editxlarge" name="editxlarge" placeholder="Type quantity of XL size">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit2xlarge" class="form-label" id="edit2xlargeLabel">Quantity ( 2Xl ):<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="edit2xlarge" name="edit2xlarge" placeholder="Type quantity of XXL size">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit3xlarge" class="form-label" id="edit3xlargeLabel">Quantity ( 3Xl ):<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="edit3xlarge" name="edit3xlarge" placeholder="Type quantity of XXXL size">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit4xlarge" class="form-label" id="edit4xlargeLabel">Quantity ( 4Xl ):<span style="color:red">&nbsp*</span></label>
                                            <input type="number" class="form-control" id="edit4xlarge" name="edit4xlarge" placeholder="Type quantity of XXXXL size">
                                        </div>                        
                                        <div class="mb-3">
                                            <label for="editdateOrdered" class="form-label">Date Ordered:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="editdateOrdered" name="editdateOrdered" placeholder="Select Ordered Date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editstaffName" class="form-label">Staff Name:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="editstaffName" name="editstaffName" required>
                                                <option value="" selected disabled>Select Staff</option>
                                                <option value="Kid Eumil T. Suco">Kid Eumil T. Suco</option>
                                                <option value="Emelda T. Suco">Emelda T. Suco</option>
                                                <option value="Leslie A. Suco">Leslie A. Suco</option>
                                                <option value="Rolannie R. Suco">Rolannie R. Suco</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editdateDeadline" class="form-label">Due Date:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="editdateDeadline" name="editdateDeadline" placeholder="Select Due Date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editorderStatus" class="form-label">Order Status:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="editorderStatus" name="editorderStatus" required>
                                                <option value="" selected disabled>Select Order Status</option>
                                                <option value="Not yet started">Not yet started</option>
                                                <option value="Started">Started</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="editExistingOrder">Update Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Add Order Modal -->

                </div> 
            </div>
            <!-- Navigation bar -->
            <?php include('../includes/footer.php');?>
        </div>
    </div> 
    
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Include jQuery and jQuery UI libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
    <!-- Include DataTables library -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script> 

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script src="script.js"></script>
</body>
</html>