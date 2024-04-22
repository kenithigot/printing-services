<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Order - Printing Services</title>

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

    <!-- DataTables Bootstrap 5 Stylesheet -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    
    <!-- Bootstrap 5 Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icon Font Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <?php include('add_jobOrder.php');?>
</head>

<body>
    <div class="content">
        <div class="container-now">
            <div class="contain">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active fs-4"><a class="color-new rm-link" href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item fs-4" aria-current="page">Job Order</li>    
                </ul>
                <div class="added-container">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobOrder-modal">Add Task</button>
                    <hr>
                    <table id="jobOrder-table" class="table table-striped display" width="100%">
                        <thead>
                            <tr>
                                <th>Task</th>    
                                <th>Staff Name</th>             
                                <th>Job Role</th>
                                <th>Due Date</th>
                                <th>Image/Picture Link</th>
                                <th>Status</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    <!-- Add Task Modal -->
                    <div class="modal fade" id="jobOrder-modal" tabindex="-1" aria-labelledby="jobOrderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="jobOrderModalLabel">Add To do Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
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
                                            <label for="add-jobRole" class="form-label">Job Role:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="add-jobRole" name="add-jobRole" onchange="toggleInputs()" required>
                                                <option value="" selected disabled>Select Job Role</option>
                                                <option value="Plate Number">Plate Number</option>
                                                <option value="Tarpaulin">Tarpaulin</option>
                                                <option value="T-shirt Printing">T-shirt Printing</option>
                                                <option value="Fullsublimation">Fullsublimation</option>
                                                <option value="Sentra board">Sentra board </option>
                                                <option value="standee">standee</option>
                                                <option value="Mug printing">Mug printing</option>
                                                <option value="School ID">School ID</option>
                                                <option value="Sticker">Sticker</option>
                                            </select>
                                        </div>
                                        <div id="tshirtPrintingInputs" style="display: none;">
                                            <div class="mb-3">
                                                <label for="add-typePrintEmbro" class="form-label">Type of Print/Embro:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="add-typePrintEmbro" name="add-typePrintEmbro" >
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
                                                <label for="add-typeCloth" class="form-label">Type of Cloths:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="add-typeCloth" name="add-typeCloth" >
                                                    <option value="" selected disabled>Select the type of Cloth</option>
                                                    <option value="Dryfit">Dryfit</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Cotton">Cotton</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="add-typeShirt" class="form-label">Type of Shirt:<span style="color:red">&nbsp*</span></label>
                                                <select class="form-control" id="add-typeShirt" name="add-typeShirt" onchange="toggleOtherInput()" >
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
                                                <label for="add-typeShirtOther" class="form-label">Applicable for Type of Shirt [Other]:<span style="color:red">&nbsp*</span></label>
                                                <input type="text" class="form-control" id="add-typeShirtOther" name="add-typeShirtOther">
                                            </div>
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-imagePictureLink" class="form-label">Image/Picture Link:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="add-imagePictureLink" name="add-imagePictureLink" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-dateDeadline" class="form-label">Due Date:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="add-dateDeadline" name="add-dateDeadline" placeholder="Select Due Date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-orderStatus" class="form-label">Order Status:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="add-orderStatus" name="add-orderStatus" required>
                                                <option value="" selected disabled>Select Order Status</option>
                                                <option value="Started">Started</option>
                                                <option value="Not yet started">Not yet started</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="saveJobOrder">Save changes</button>
                                    </div>
                                </form>
                            </div>       
                        </div>
                    </div>
                    <!-- End of Add Task Modal -->

                    <!-- View Task Modal -->
                    <div class="modal fade bd-example-modal-xl" id="viewJobOrder-modal" tabindex="-1" aria-labelledby="viewJobOrderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewJobOrderModalLabel">View Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" class="id">
                                        <div class="form-inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-jobRole">Job Role:<span style="color:red">&nbsp*</span></label>   
                                                <label class="custom-control-label fs-5" id="view-jobRole" name="view-jobRole"></label>   
                                            </div>
                                            <br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2 fw-bold"style="text-decoration:underline">Task Details:</label>   
                                                
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2 fw-bold" for="view-typePrintEmbro">Type of Print/Embro:<span style="color:red">&nbsp*</span></label>   
                                                <label class="custom-control-label fs-5" id="view-typePrintEmbro" name="view-typePrintEmbro"></label>   
                                            </div>
                                            
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2  fw-bold" for="view-typeShirt">Type of Shirt:<span style="color:red">&nbsp*</span></label>   
                                                <label class="custom-control-label fs-5" id="view-typeShirt" name="view-typeShirt"></label>   
                                            </div>
                                            
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2  fw-bold" for="view-typeShirtOther">Type of Shirt[Other]:<span style="color:red">&nbsp*</span></label>   
                                                <label class="custom-control-label fs-5" id="view-typeShirtOther" name="view-typeShirtOther"></label>   
                                            </div>
                                            
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <label class="custom-control-label fs-5 px-2  fw-bold" for="view-typeCloth">Type of Cloth:<span style="color:red">&nbsp*</span></label>   
                                                <label class="custom-control-label fs-5" id="view-typeCloth" name="view-typeCloth"></label>   
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>       
                        </div>
                    </div>
                    <!-- End of View Task Modal -->
                    
                    <!-- Edit Task Modal -->
                    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editjobOrderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editjobOrderModalLabel">Edit Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="id" name="id" value="">
                                        <div class="mb-3">
                                            <label for="staffName" class="form-label">Staff Name:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="staffName" name="staffName" required>
                                                <option value="" selected disabled>Select Staff</option>
                                                <option value="Kid Eumil T. Suco">Kid Eumil T. Suco</option>
                                                <option value="Emelda T. Suco">Emelda T. Suco</option>
                                                <option value="Leslie A. Suco">Leslie A. Suco</option>
                                                <option value="Rolannie R. Suco">Rolannie R. Suco</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jobRole" class="form-label">Job Role:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="jobRole" name="jobRole" onchange="toggleInputs()">
                                                <option value="" selected disabled>Select Job Role</option>
                                                <option value="Plate Number">Plate Number</option>
                                                <option value="Tarpaulin">Tarpaulin</option>
                                                <option value="T-shirt Printing">T-shirt Printing</option>
                                                <option value="Fullsublimation">Fullsublimation</option>
                                                <option value="Sentra board">Sentra board </option>
                                                <option value="standee">standee</option>
                                                <option value="Mug printing">Mug printing</option>
                                                <option value="School ID">School ID</option>
                                                <option value="Sticker">Sticker</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="typePrintEmbro" class="form-label">Type of Print/Embro:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="typePrintEmbro" name="typePrintEmbro" >
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
                                            <label for="typeCloth" class="form-label">Type of Cloths:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="typeCloth" name="typeCloth" >
                                                <option value="" selected disabled>Select the type of Cloth</option>
                                                <option value="Dryfit">Dryfit</option>
                                                <option value="Active">Active</option>
                                                <option value="Cotton">Cotton</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="typeShirt" class="form-label">Type of Shirt:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="typeShirt" name="typeShirt">
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
                                            <label for="typeShirtOther" class="form-label">Applicable for Type of Shirt [Other]:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="typeShirtOther" name="typeShirtOther">
                                        </div> 
                                        <div class="mb-3">
                                            <label for="imagePictureLink" class="form-label">Image/Picture Link:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="imagePictureLink" name="imagePictureLink">
                                        </div>
                                        <div class="mb-3">
                                            <label for="dateDeadline" class="form-label">Due Date:<span style="color:red">&nbsp*</span></label>
                                            <input type="text" class="form-control" id="dateDeadline" name="dateDeadline" placeholder="Select Due Date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="orderStatus" class="form-label">Order Status:<span style="color:red">&nbsp*</span></label>
                                            <select class="form-control" id="orderStatus" name="orderStatus">
                                                <option value="" selected disabled>Select Order Status</option>
                                                <option value="Started">Started</option>
                                                <option value="Not yet started">Not yet started</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="saveTaskOrder">Save changes</button>
                                    </div>
                                </form>
                            </div>       
                        </div>
                    </div>
                    <!-- End of Edit Task Modal --> 

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
