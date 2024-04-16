<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client - Printing Services</title>

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
    
</head>
<style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}
</style>
<body>
    <div class="content clearfix">
        <div class="contain">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active fs-4"><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                <li class="breadcrumb-item fs-4" aria-current="page">Client</li>    
            </ul>
            <div class="client-container">
                <button id="add-client-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#client-modal">Add New Client</button>
                <hr>
                <table id="client-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Client</th>                 
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- Add Client Modal -->
                <div class="modal fade" id="client-modal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="clientModalLabel">Add Client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="client" class="form-label">Name:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="client">
                                </div>
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact Number:<span style="color:red">&nbsp*</span></label>
                                    <input type="number" class="form-control" id="contact">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="address">
                                </div>
                                <div class="mb-3">
                                    <label for="facebook_account" class="form-label">Facebook Account:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="facebook_account">
                                </div>
                                <div class="mb-3">
                                    <label for="email_address" class="form-label">Email Address:<span style="color:red">&nbsp*</span></label>
                                    <input type="email" class="form-control" id="email_address">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:<span style="color:red">&nbsp*</span></label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Add Client Modal -->
            </div> 
        </div>
        
        <!-- Navigation bar -->
        <?php include('../includes/footer.php');?>
    </div> 
   
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script> 
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script src="script.js"></script>
</body>
</html>
