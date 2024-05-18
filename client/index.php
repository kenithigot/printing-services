<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../');  // Redirect to landing page if not logged in
    exit;
}
?>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <?php include('add_client.php');?>
</head>

<body>
    <div class="content">
        <div class="container-now">
        <div class="contain">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active fs-4"><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                <li class="breadcrumb-item fs-4" aria-current="page">Client</li>    
            </ul>
            <div class="added-container">
                <button id="add-client-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#client-modal">Add New Client</button>
                <hr>
                <table id="client-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Client Name</th>                 
                            <th>Address</th>
                            <th>Facebook Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- Add Client Modal -->
                <div class="modal fade" id="client-modal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientModalLabel">Add Client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">  
                                    <div class="mb-3">
                                        <label for="client" class="form-label">Name:<span style="color:red">&nbsp*</span></label>
                                        <input type="text" class="form-control" id="add-client_name" name="add-client_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact" class="form-label">Contact Number:<span style="color:red">&nbsp*</span></label>
                                        <input type="number" class="form-control" id="add-contactNum" name="add-contactNum">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address:<span style="color:red">&nbsp*</span></label>
                                        <input type="text" class="form-control" id="add-clientAddress" name="add-clientAddress">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fb_account" class="form-label">Facebook Account:<span style="color:red">&nbsp*</span></label>
                                        <input type="text" class="form-control" id="add-fb_account" name="add-fb_account">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_address" class="form-label">Email Address:<span style="color:red">&nbsp*</span></label>
                                        <input type="email" class="form-control" id="add-email" name="add-email">
                                    </div>                     
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="SaveAddClient">Save changes</button>
                                </div>
                            </form>
                        </div>       
                    </div>
                </div>
                <!-- End of Add Client Modal -->

                <!-- Edit Client Modal -->
                <div class="modal fade" id="edit-client" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">  
                            <input type="hidden" name="id" class="id">
                                <div class="mb-3">
                                    <label class="form-label">Name:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="client_name" name="client_name">
                                </div>
                                <div class="mb-3">
                                    <labe class="form-label">Contact Number:<span style="color:red">&nbsp*</span></labe>
                                    <input type="number" class="form-control" id="contactNum" name="contactNum">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="clientAddress" name="clientAddress">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Facebook Account:<span style="color:red">&nbsp*</span></label>
                                    <input type="text" class="form-control" id="fb_account" name="fb_account">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address:<span style="color:red">&nbsp*</span></label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>                     
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="updateClient">Save changes</button>
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
