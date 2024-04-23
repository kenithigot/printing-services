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
    
    <?php include('add_expenses.php');?>
</head>

<body>
    <div class="content">
        <div class="container-now">
        <div class="contain">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active fs-4"><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                <li class="breadcrumb-item fs-4" aria-current="page">Expenses</li>    
            </ul>
            <div class="added-container">
                <button id="add-expenses-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#expenses-modal">Add Expenses</button>
                <hr>
                <table id="expenses-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>                 
                            <th>Item</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- Add Client Modal -->
                <div class="modal fade" id="expenses-modal" tabindex="-1" aria-labelledby="expensesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="expensesModalLabel">Add Expenses</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">  
                                    <div class="mb-3">
                                        <label for="add-date" class="form-label">Date:<span style="color:red">&nbsp*</span></label>
                                        <input type="text" class="form-control" id="add-date" name="add-date" placeholder="SelectDate">
                                    </div>
                                    <div class="mb-3">
                                        <label for="item" class="form-label">Item:<span style="color:red">&nbsp*</span></label>
                                        <input type="text" class="form-control" id="add-item" name="add-item">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category:<span style="color:red">&nbsp*</span></label>
                                        <input type="text" class="form-control" id="add-category" name="add-category">
                                    </div>
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount:<span style="color:red">&nbsp*</span></label>
                                        <input type="number" class="form-control" id="add-amount" name="add-amount">
                                    </div>                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="SaveAddExpenses">Save changes</button>
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
</body>
</html>
