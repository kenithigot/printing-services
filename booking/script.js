$(document).ready(function () {
    var table = $('#client-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-order.php",
            "type": "POST"
        },
        "columns": [
            { "data": "client" },
            { "data": "type_order" },
            { "data": "type_print" },
            { "data": "type_shirt" },
            { "data": "type_cloth" },
            { "data": "xs" },
            { "data": "s" },
            { "data": "m" },
            { "data": "l" },
            { "data": "xl" },
            { "data": "xxl" },
            { "data": "3xl" },
            { "data": "4xl" },
            { "data": "tarp_size" },
            { "data": "plate_number" },
            { "data": "quantity" },
            { "data": "date_ordered" },
            { "data": "due_date" },
            { "data": "staff" },
            { "data": "order_status" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary ms-2 mt-2 editJoborderBtn" data-bs-toggle="modal" data-bs-target="#edit-client" data-id="' + row.id + '">Edit</button>' +
                        '<button class="btn btn-success ms-2 mt-2 saveTaskBtn" data-id="' + row.id + '">Done Task</button>';
                }
            }
        ],
        "order": [[0, 'asc']]
    });

    // Datepicker initialization
    $(function() {
        $("#add-dateDeadline, #add-dateOrdered").datepicker({
            dateFormat: 'DD, d MM, yy'
        });
    });

    // Call toggleInputs on order type change
    $("#add-order").change(function() {
        toggleInputs();
    });

    // Call toggleOtherInput on type of shirt change
    $("#add-typeShirt").change(function() {
        toggleOtherInput();
    });

    // Form submission
    $("#orderForm").submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: "add_order.php", // URL where the form data should be submitted
            type: "POST",
            data: formData,
            dataType: "json", // Expected data type from the server
            success: function(response) {
                if (response.status === "success") {
                    // Success message, maybe show a modal or redirect
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then(() => {
                        // Redirect to orders page
                        window.location.href = '../booking/';
                    });
                } else {
                    // Error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Error message if AJAX request fails
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request. Please try again.'
                });
            }
        });
    });
});

// Function to toggle inputs based on order type
function toggleInputs() {
    var jobRole = $("#add-order").val();
    var tshirtPrintingInputs = $("#tshirtPrintingInputs");
    var typeShirtOtherInput = $("#typeShirtOtherInput");
    var platenumberinput = $("#platenumberinput");
    var tarpaulinInput = $("#tarpaulinInput");

    // Hide/show inputs based on selected order type
    if (jobRole === "T-shirt Printing") {
        tshirtPrintingInputs.show();
        platenumberinput.hide();
        tarpaulinInput.hide();
    } else if (jobRole === "Plate Number") {
        tshirtPrintingInputs.hide();
        typeShirtOtherInput.hide();
        platenumberinput.show();
        tarpaulinInput.hide();
    } else if (jobRole === "Tarpaulin") {
        tshirtPrintingInputs.hide();
        typeShirtOtherInput.hide();
        platenumberinput.hide();
        tarpaulinInput.show();
    } else {
        // Hide all inputs if none of the options match
        tshirtPrintingInputs.hide();
        typeShirtOtherInput.hide();
        platenumberinput.hide();
        tarpaulinInput.hide();
    }
}

// Function to toggle "Other" type shirt input
function toggleOtherInput() {
    var typeShirt = $("#add-typeShirt").val();
    var typeShirtOtherInput = $("#typeShirtOtherInput");

    // Show/hide "Other" type shirt input based on selection
    if (typeShirt === "Other") {
        typeShirtOtherInput.show();
    } else {
        typeShirtOtherInput.hide();
    }
}
