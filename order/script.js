$(document).ready(function () {
    var table = $('#order-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-order.php",
            "type": "POST"
        },
        "columns": [
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary viewOrderBtn" data-bs-toggle="modal" data-bs-target="#viewOrder-modal" data-id="' + row.id + '">View</button>'                          
                }
            },
            { "data": "client" },
            { "data": "quantity" },
            { "data": "type_order" },
            { "data": "date_ordered" },
            { "data": "due_date" },
            { "data": "order_status" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary editOrderBtn" data-id="' + row.id + '">Edit</button>' +
                    '<button class="btn btn-success ms-2 doneOrderBtn" data-id="' + row.id + '">Done</button>'
                        
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
    
    $(document).on('click', '.viewOrderBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
    
        $.ajax({
            url: 'viewOrder.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response) {
                    // Populate the labels with data
                    $('#view-jobRole').text(response.type_order);
                    $('#view-client').text(response.client);
                    $('#view-quantity').text(response.quantity);
                    $('#view-dateOrdered').text(response.date_ordered);
                    $('#view-dueDate').text(response.due_date);
                    $('#view-staff').text(response.staff);
                    $('#view-orderStatus').text(response.order_status);
    
                    // Show the modal
                    $('#viewOrder-modal').modal('show');
    
                    // Display additional fields if type_order is "T-shirt Printing"
                    if (response.type_order === "T-shirt Printing") {
                        $('.shirt-fields').show();
                        $('#view-typePrintEmbro-label').show();
                        $('#view-typePrintEmbro').text(response.type_print);
                        

                        if(response.type_tshirt === "Other"){
                            $('#view-typeShirt-label').show();
                            $('#view-typeShirt').text(response.type_tshirt);
                            $('#view-typeShirtOther-label').show();
                            $('#view-typeShirtOther').text(response.typeShirtOther);
                        }else{
                            $('#view-typeShirt-label').hide();
                            $('#view-typeShirt').empty();
                            $('#view-typeShirtOther-label').hide();
                            $('#view-typeShirtOther').empty();
                        }
                        
                        
                        $('#view-typeCloth-label').show();
                        $('#view-typeCloth').text(response.type_cloth);
    
                        // Display size labels and hide if value is zero
                        $('.size-fields').show();
                        $('#view-xssize-label').toggle(response.x_small !== "0");
                        $('#view-xssize').toggle(response.x_small !== "0").text(response.x_small);
                        $('#view-ssize-label').toggle(response.small !== "0");
                        $('#view-ssize').toggle(response.small !== "0").text(response.small);
                        $('#view-msize-label').toggle(response.medium !== "0");
                        $('#view-msize').toggle(response.medium !== "0").text(response.medium);
                        $('#view-lsize-label').toggle(response.large !== "0");
                        $('#view-lsize').toggle(response.large !== "0").text(response.large);
                        $('#view-xlsize-label').toggle(response.x_large !== "0");
                        $('#view-xlsize').toggle(response.x_large !== "0").text(response.x_large);
                        $('#view-xxlsize-label').toggle(response.xx_large !== "0");
                        $('#view-xxlsize').toggle(response.xx_large !== "0").text(response.xx_large);
                        $('#view-xxxlsize-label').toggle(response.xxx_large !== "0");
                        $('#view-xxxlsize').toggle(response.xxx_large !== "0").text(response.xxx_large);
                        $('#view-xxxxlsize-label').toggle(response.xxxx_large !== "0");
                        $('#view-xxxxlsize').toggle(response.xxxx_large !== "0").text(response.xxxx_large);
                    } else {
                        $('.shirt-fields').hide();
                        $('#view-typePrintEmbro-label').hide();
                        $('#view-typePrintEmbro').empty();
                        $('#view-typeShirt-label').hide();
                        $('#view-typeShirt').empty();
                        $('#view-typeShirtOther-label').hide();
                        $('#view-typeShirtOther').empty();
                        $('#view-typeCloth-label').hide();
                        $('#view-typeCloth').empty();
    
                        // Hide size labels
                        $('.size-fields').hide();
                        $('#view-xssize-label').hide();
                        $('#view-xssize').empty();
                        $('#view-ssize-label').hide();
                        $('#view-ssize').empty();
                        $('#view-msize-label').hide();
                        $('#view-msize').empty();
                        $('#view-lsize-label').hide();
                        $('#view-lsize').empty();
                        $('#view-xlsize-label').hide();
                        $('#view-xlsize').empty();
                        $('#view-xxlsize-label').hide();
                        $('#view-xxlsize').empty();
                        $('#view-xxxlsize-label').hide();
                        $('#view-xxxlsize').empty();
                        $('#view-xxxxlsize-label').hide();
                        $('#view-xxxxlsize').empty();
                    }

                    if(response.type_order === "Plate Number"){
                        $('#view-plate_number-label').show();
                        $('#view-plate_number').text(response.plate_number);
                    }else{
                        $('#view-plate_number-label').hide();
                        $('#view-plate_number').empty();
                    }

                    if(response.type_order === "Tarpaulin"){
                        $('#view-tarpaulin-label').show();
                        $('#view-tarpaulin').text(response.tarp_size);
                    }else{
                        $('#view-tarpaulin-label').hide();
                        $('#view-tarpaulin').empty();
                    }


                } else {
                    console.error("No data available for any label.");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Done Order Deletion 
    $(document).on('click', '.doneOrderBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'By clicking done order means marking the order as completed.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#157347',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Done Order'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'doneOrder.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: "success",
                                title: "Done Order",
                                text: "Order completed successfully."
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Failed to Accomplished the Order."
                            });
                        }
                    },
                    error: function () {
                        alert('Error deleting Task');
                    }
                });
            }
        });
    });

    //Edit Order
    $(document).on('click', '.editOrderBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
    
        $.ajax({
            url: 'viewOrder.php',
            type: 'POST',
            data: {id:id },
            dataType: 'json',
            success: function (response) {
                $('#editclientName').val(response.client); 
                $('#editorder').val(response.type_order);
                $('#editcommonQuantity').val(response.quantity);
                $('#editplate_number').val(response.plate_number);
                $('#edittarpaulinSize').val(response.tarp_size);
                $('#edittypePrintEmbro').val(response.type_print);
                $('#edittypeCloth').val(response.type_cloth);
                $('#edittypeShirt').val(response.type_tshirt);
                $('#edittypeShirtOther').val(response.typeShirtOther);
                $('#editxsmall').val(response.x_small);
                $('#editsmall').val(response.small); 
                $('#editmedium').val(response.medium);
                $('#editlarge').val(response.large);
                $('#editxlarge').val(response.x_large);
                $('#edit2xlarge').val(response.xx_large);
                $('#edit3xlarge').val(response.xxx_large);
                $('#edit4xlarge').val(response.xxxx_large);
                $('#editdateOrdered').val(response.date_ordered);
                $('#editdateDeadline').val(response.due_date);
                $('#editstaffName').val(response.staff);
                $('#editorderStatus').val(response.order_status);
                
                //Show/Hide Tshirt Printing Related
                if (response.type_order == 'T-shirt Printing') {
                    $('#edittypePrintEmbro, #edittypeCloth , #edittypeShirt, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge').show();
                    $('#edittypePrintEmbroLabel, #edittypeClothLabel, #edittypeShirtLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel').show();  
                    
                    $('#editcommonQuantity').hide();
                    $('#editcommonQuantityLabel').hide();
                } else {
                    $('#edittypePrintEmbro, #edittypeCloth , #edittypeShirt, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge').hide();
                    $('#edittypePrintEmbroLabel, #edittypeClothLabel, #edittypeShirtLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel').hide();
                }
                if (response.type_tshirt == 'Other'){
                    $('#edittypeShirtOther').show();
                    $('#edittypeShirtOtherLabel').show();
                }else{
                    $('#edittypeShirtOther').hide();
                    $('#edittypeShirtOtherLabel').hide();
                }

                //Show/Hide Plate Number Related
                if (response.type_order == 'Plate Number') {
                    $('#editplate_number').show();
                    $('#editplate_numberLabel').show();
                    
                } else {
                    $('#editplate_number').hide();
                    $('#editplate_numberLabel').hide();
                }

                //Show/Hide Tarpalin Size Related
                if (response.type_order == 'Tarpaulin') {
                    $('#edittarpaulinSize').show();
                    $('#edittarpaulinSizeLabel').show();
                    
                } else {
                    $('#edittarpaulinSize').hide();
                    $('#edittarpaulinSizeLabel').hide();
                }
                    
                $('#editOrder-modal').modal('show');
                $('#editExistingOrder').data('id', id);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

// Update Task Order
$('#editExistingOrder').click(function () {
    var id = $(this).data('id');

    // Get the form data
    var OrderData = {
        id: id,
        editclientName: $('#editclientName').val(),
        editorder: $('#editorder').val(),
        edittypePrintEmbro: $('#edittypePrintEmbro').val(),
        edittypeCloth: $('#edittypeCloth').val(),
        edittypeShirt: $('#edittypeShirt').val(),
        edittypeShirtOther: $('#edittypeShirtOther').val(),
        editdateDeadline: $('#editdateDeadline').val(),
        editorderStatus: $('#editorderStatus').val(),
        editcommonQuantity: $('#editcommonQuantity').val(),
        editplate_number: $('#editplate_number').val(),
        edittarpaulinSize: $('#edittarpaulinSize').val(),
        editxsmall: $('#editxsmall').val(),
        editsmall: $('#editsmall').val(),
        editmedium: $('#editmedium').val(),
        editlarge: $('#editlarge').val(),
        editxlarge: $('#editxlarge').val(),
        edit2xlarge: $('#edit2xlarge').val(),
        edit3xlarge: $('#edit3xlarge').val(),
        edit4xlarge: $('#edit4xlarge').val(),
        editdateOrdered: $('#editdateOrdered').val(),
        editstaffName: $('#editstaffName').val()
    };

    $.ajax({
        url: 'updateOrder.php',
        type: 'POST',
        data: OrderData,
        dataType: 'json',
        success: function (response) {
            if(response.success) {
                Swal.fire({
                    icon: "success",
                    title: "Successfully Updated!",
                    text: "Order Data Updated successfully."
                }).then(function () {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Insufficient Size(s)!",
                    html: "Limited inventory for these following sizes: <br>" + response.error
                });
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error Updating Order');
        }
    });
});


    });
    // Event listener for order selection change
    $('#editorder').change(function() {
        if ($(this).val() == 'T-shirt Printing') {
            $('#edittypePrintEmbro, #edittypeCloth , #edittypeShirt, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge').show();
            $('#edittypePrintEmbroLabel, #edittypeClothLabel, #edittypeShirtLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel').show();
            
            $('#editcommonQuantity').hide();
            $('#editcommonQuantityLabel').hide();

            // Hide Type Shirt Other field initially
            $('#edittypeShirtOther').hide();
            $('#edittypeShirtOtherLabel').hide();
        } else {
            $('#edittypePrintEmbro, #edittypeCloth , #edittypeShirt, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge').hide();
            $('#edittypePrintEmbroLabel, #edittypeClothLabel, #edittypeShirtLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel').hide();
            
            // Hide Type Shirt Other field when order type is not T-shirt Printing
            $('#edittypeShirtOther').hide();
            $('#edittypeShirtOtherLabel').hide();

            $('#editcommonQuantity').show();
            $('#editcommonQuantityLabel').show();
        }
    });

    // Event listener for order Plate Number selection change
    $('#editorder').change(function() {
        if ($(this).val() == 'Plate Number') {
            $('#editplate_number').show();
            $('#editplate_numberLabel').show();
        } else {
            $('#editplate_number').hide();
            $('#editplate_numberLabel').hide();
        }
    });

    // Event listener for order Tarpaulin selection change
    $('#editorder').change(function() {
        if ($(this).val() == 'Tarpaulin') {
            $('#edittarpaulinSize').show();
            $('#edittarpaulinSizeLabel').show();
        } else {
            $('#edittarpaulinSize').hide();
            $('#edittarpaulinSizeLabel').hide();
        }
    });

   // Event listener for type Shirt selection change 
    $('#edittypeShirt').change(function() {
        if ($('#editorder').val() == 'T-shirt Printing' && $(this).val() == 'Other') {
            $('#edittypeShirtOther').show();
            $('#edittypeShirtOtherLabel').show();
        } else {
            $('#edittypeShirtOther').hide();
            $('#edittypeShirtOtherLabel').hide();
        }
    });

    
});


// Function to toggle inputs based on order type
function toggleInputs() {
    var jobRole = $("#add-order").val();
    var tshirtPrintingInputs = $("#tshirtPrintingInputs");
    var typeShirtOtherInput = $("#typeShirtOtherInput");
    var platenumberinput = $("#platenumberinput");
    var tarpaulinInput = $("#tarpaulinInput");
    var commonQuantityInput = $("#commonQuantityInput");
    

    // Hide/show inputs based on selected order type
    if (jobRole === "T-shirt Printing") {
        tshirtPrintingInputs.show();
        typeShirtOtherInput.hide();
        platenumberinput.hide();
        tarpaulinInput.hide();
        commonQuantityInput.hide();
    } else if (jobRole === "Plate Number") {
        tshirtPrintingInputs.hide();
        typeShirtOtherInput.hide();
        platenumberinput.show();
        tarpaulinInput.hide();
        commonQuantityInput.show();
    } else if (jobRole === "Tarpaulin") {
        tshirtPrintingInputs.hide();
        typeShirtOtherInput.hide();
        platenumberinput.hide();
        tarpaulinInput.show();
        commonQuantityInput.show();
    } else {
        // Hide all inputs if none of the options match
        tshirtPrintingInputs.hide();
        typeShirtOtherInput.hide();
        platenumberinput.hide();
        tarpaulinInput.hide();
        commonQuantityInput.show();
    }
}

// Function to toggle "Other" type shirt input
function toggleOtherInput() {
    var typeShirt = $("#typeShirt").val();
    var typeShirtOtherInput = $("#typeShirtOtherInput");

    // Show/hide "Other" type shirt input based on selection
    if (typeShirt === "Other") {
        typeShirtOtherInput.show();
    } else {
        typeShirtOtherInput.hide();
    }
}


