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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script> 

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <body >
        <div class="content">
            <div class="contain">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active fs-4" ><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item fs-4" aria-current="page">Client</a></li>    
                </ul>

                <table id="client-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>                 
                            <th>Company</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>                 
                            <th>Company</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>     
                </table>
            </div>
        </div> 
    </body>
    
    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

    <script src="script.js"></script>
</html>


