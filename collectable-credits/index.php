<!DOCTYPE html>
<html lang="en">
<head>
    <title>Collectable  Credits- Printing Services</title>

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

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <!-- <?php include('add_collectable_credits.php');?> -->
</head>

<body>
    <div class="content">
        <div class="container-now">
        <div class="contain">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active fs-4"><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                <li class="breadcrumb-item fs-4" aria-current="page">Collectable Credits</li>    
            </ul>
            <div class="added-container">
                <button id="add-credits-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#credits-modal">Add Order</button>
                <button id="resetTableBtn" class="btn btn-secondary">Reset Table</button>
                <hr>
                <table id="credits-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item</th>                 
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- Add Client Modal -->
                <div class="modal fade" id="credits-modal" tabindex="-1" aria-labelledby="creditsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="creditsModalLabel">Add Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">  
                                        <div class="mb-3">
                                            <label for="add-item" class="form-label">Item:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="add-item" name="add-item" onchange="toggleInputs()" required>
                                                <option value="" selected disabled>Select Item</option>
                                                <option value="Lamination">Lamination</option>
                                                <option value="Recopy">Recopy</option>
                                                <option value="Photocopy">Photocopy</option>
                                                <option value="Print">Print</option>
                                                <option value="Tarpaulin">Tarpaulin</option>
                                                <option value="Rush ID">Rush ID</option>
                                            </select>
                                        </div>
                                        <div id="tarpaulin" style="display: none;">
                                            <div class="mb-3">
                                                <label for="add-tarpaulin" class="form-label">Type of T-shirt:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="add-tarpaulin" name="add-tarpaulin" >
                                                    <option value="" selected disabled>Select the Size of Tarpaulin</option>
                                                    <option value="2x3">2x3</option>
                                                    <option value="2x4">2x4</option>
                                                    <option value="2x5">2x5</option>
                                                    <option value="2x6">2x6</option>
                                                    <option value="2x7">2x7</option>
                                                    <option value="2x8">2x8</option>
                                                    <option value="2x9">2x9</option>
                                                    <option value="2x10">2x10</option>
                                                    <option value="2x11">2x11</option>
                                                    <option value="2x12">2x12</option>
                                                    <option value="2x13">2x13</option>
                                                    <option value="2x14">2x14</option>
                                                    <option value="2x15">2x15</option>
                                                    <option value="2x16">2x16</option>
                                                    <option value="2x17">2x17</option>
                                                    <option value="2x18">2x18</option>
                                                    <option value="2x19">2x19</option>
                                                    <option value="2x20">2x20</option>
                                                    <option value="2x21">2x21</option>
                                                    <option value="2x22">2x22</option>
                                                    <option value="3x3">3x3</option>
                                                    <option value="3x4">3x4</option>
                                                    <option value="3x5">3x5</option>
                                                    <option value="3x6">3x6</option>
                                                    <option value="3x7">3x7</option>
                                                    <option value="3x8">3x8</option>
                                                    <option value="3x9">3x9</option>
                                                    <option value="3x10">3x10</option>
                                                    <option value="3x11">3x11</option>
                                                    <option value="3x12">3x12</option>
                                                    <option value="3x13">3x13</option>
                                                    <option value="3x14">3x14</option>
                                                    <option value="3x15">3x15</option>
                                                    <option value="3x16">3x16</option>
                                                    <option value="3x17">3x17</option>
                                                    <option value="3x18">3x18</option>
                                                    <option value="3x19">3x19</option>
                                                    <option value="3x20">3x20</option>
                                                    <option value="3x21">3x21</option>
                                                    <option value="4x2">4x2</option>
                                                    <option value="4x3">4x3</option>
                                                    <option value="4x4">4x4</option>
                                                    <option value="4x5">4x5</option>
                                                    <option value="4x6">4x6</option>
                                                    <option value="4x7">4x7</option>
                                                    <option value="4x8">4x8</option>
                                                    <option value="4x9">4x9</option>
                                                    <option value="4x10">4x10</option>
                                                    <option value="4x11">4x11</option>
                                                    <option value="4x12">4x12</option>
                                                    <option value="4x13">4x13</option>
                                                    <option value="4x14">4x14</option>
                                                    <option value="4x15">4x15</option>
                                                    <option value="4x16">4x16</option>
                                                    <option value="4x17">4x17</option>
                                                    <option value="4x18">4x18</option>
                                                    <option value="4x19">4x19</option>
                                                    <option value="4x20">4x20</option>
                                                    <option value="4x21">4x21</option>
                                                    <option value="5x2">5x2</option>
                                                    <option value="5x3">5x3</option>
                                                    <option value="5x4">5x4</option>
                                                    <option value="5x5">5x5</option>
                                                    <option value="5x6">5x6</option>
                                                    <option value="5x7">5x7</option>
                                                    <option value="5x8">5x8</option>
                                                    <option value="5x9">5x9</option>
                                                    <option value="5x10">5x10</option>
                                                    <option value="5x11">5x11</option>
                                                    <option value="5x12">5x12</option>
                                                    <option value="5x13">5x13</option>
                                                    <option value="5x14">5x14</option>
                                                    <option value="5x15">5x15</option>
                                                    <option value="5x16">5x16</option>
                                                    <option value="5x17">5x17</option>
                                                    <option value="5x18">5x18</option>
                                                    <option value="5x19">5x19</option>
                                                    <option value="5x20">5x20</option>
                                                    <option value="5x21">5x21</option>                                               
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="add-tarpaulinType" class="form-label">Tarpaulin Type:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="add-tarpaulinType" name="add-tarpaulinType" >
                                                    <option value="" selected disabled>Select Type</option>
                                                    <option value="Studio Shoot">No layout</option>
                                                    <option value="Recopy">Rush</option>
                                                </select>
                                            </div>                                          
                                        </div>                                       
                                        <div id="rushid" style="display: none;">
                                            <div class="mb-3">
                                                <label for="add-rushid" class="form-label">Rush ID:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="add-rushid" name="add-rushid" >
                                                    <option value="" selected disabled>Select Set</option>
                                                    <option value="Set 1 5pcs. 2x2 & 4pcs. 1x1">Set 1 5pcs. 2x2 & 4pcs. 1x1</option>
                                                    <option value="Set 2 4pcs. 2x2 &8pcs. 1x1">Set 2 4pcs. 2x2 &8pcs. 1x1</option>
                                                    <option value="Set 3 8pcs. Passport Size">Set 3 8pcs. Passport Size</option>
                                                    <option value="Set 4 6pcs. Passport Size 3pcs. 1x1">Set 4 6pcs. Passport Size 3pcs. 1x1</option>
                                                    <option value="Set 5 ASA 4pcs. ID and 6pcs. 1x1 ">Set 5 ASA 4pcs. ID and 6pcs. 1x1 </option>
                                                </select>
                                            </div>    
                                            <div class="mb-3">
                                                <label for="add-rushidType" class="form-label">Rush ID:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="add-rushidType" name="add-rushidType" >
                                                    <option value="" selected disabled>Select Type</option>
                                                    <option value="Studio Shoot">Studio Shoot</option>
                                                    <option value="Recopy">Recopy</option>
                                                </select>
                                            </div>                                      
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-quantity" class="form-label">Quantity:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="add-quantity" name="add-quantity" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-date" class="form-label">Date:<span style="color:red">&nbsp*</span></label>
                                            <input type="date" class="form-control" id="add-date" name="add-date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-price" class="form-label">Price:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="add-price" name="add-price" required>
                                        </div>                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="saveCredits">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>       
                    </div>
                </div>
                <!-- End of Add Client Modal -->


                <!-- Edit Client Modal -->
                <div class="modal fade" id="edit-expenses" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Expenses</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">  
                            <input type="hidden" name="id" class="id">
                                <div class="mb-3">
                                    <label class="form-label">Date:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="date" name="date">
                                </div>
                                <div class="mb-3">
                                    <labe class="form-label">Item:<span style="color:red">&nbsp*</span></labe>
                                    <input type="text" class="form-control" id="item" name="item">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="category" name="category">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount:<span style="color:red">&nbsp*</span></label>
                                    <input type="number" class="form-control" id="amount" name="amount">
                                </div>                     
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="updateExpenses">Save changes</button>
                            </div>    
                        </div>       
                    </div>
                </div>
                <!-- End of Edit Client Modal -->
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
    <script>
    // Automatically set today's date
    document.getElementById('add-date').valueAsDate = new Date();




</script>
</body>
</html>







