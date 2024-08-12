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
                    <hr>
                    <table id="credits-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Client</th>                 
                                <th>Order</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Date Ordered</th>
                                <th>Order Status</th>
                                <th>Staff Assigned</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- Edit Client Modal -->
                    <div class="modal fade" id="edit-expenses" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Credits</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">  
                                <input type="hidden" name="id" class="id">
                                    <div class="mb-3">
                                        <label class="form-label">Date:<span style="color:red">&nbsp*</span></label>
                                        <input type="text" class="form-control" id="date" name="date">
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
    </body>
</html>







