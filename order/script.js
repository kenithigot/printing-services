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
                    return '<button class="btn btn-primary viewOrderBtn" data-bs-toggle="modal" data-bs-target="#viewOrder-modal" data-id="' + row.id + '">View</button>' +
                    '<button class="btn btn-danger ms-2 deleteOrder" data-id="' + row.id + '">Delete</button>'                        
                }
            },
            { "data": "quantity" },
            { "data": "productPrice" },
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
                    
                    var productPrice = "Php " + response.productPrice;
                    $('#view-productPrice').text(productPrice);
                    $('#view-quantity').text(response.quantity);
                    $('#view-payment').text(response.payment);
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
                        $('#view-printingDetail-label').show();
                        $('#view-printingDetail').text(response.printingDetail);                       
                        $('#view-layoutTarp-label').hide();
                        $('#view-layoutTarp').empty();
                        
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
                        $('#view-printingDetail-label').hide();
                        $('#view-printingDetail').empty();
    
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
                        $('#view-productPromo-label').show();
                        $('#view-productPromo').text(response.productPromo);
                    }else{
                        $('#view-plate_number-label').hide();
                        $('#view-plate_number').empty();
                        $('#view-productPromo-label').hide();
                        $('#view-productPromo').empty();
                    }

                    if(response.type_order === "Tarpaulin"){
                        $('#view-tarpaulin-label').show();
                        $('#view-tarpaulin').text(response.tarp_size);
                        $('#view-layoutTarp-label').show();
                        $('#view-layoutTarp').text(response.tarpLayout);
                    }else{
                        $('#view-tarpaulin-label').hide();
                        $('#view-tarpaulin').empty();
                        $('#view-layoutTarp-label').hide();
                        $('#view-layoutTarp').empty();
                    }

                    if(response.type_order === "ID"){
                        $('#view-productId-label').show();
                        $('#view-productId').text(response.customerId);
                    }else{
                        $('#view-productId-label').hide();
                        $('#view-productId').empty();
                    }
  
                    if(response.type_order === "Mug printing"){
                        $('#view-mugPromo-label').show();
                        $('#view-mugPromo').text(response.productPromo);
                    }else{
                        $('#view-mugPromo-label').hide();
                        $('#view-mugPromo').empty();
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

     // Delete Order Deletion 
     $(document).on('click', '.deleteOrder', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'By clicking Delete Order means all materials will be restored back to the inventory.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Delete Order'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete_order.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: "success",
                                title: "Order Deleted",
                                text: "Order Deleted successfully."
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Failed to Accomplished deleting the Order."
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
                $('#editplatenumPrice').val(response.productPromo);
                $('#edittarpaulinSize').val(response.tarp_size);
                $('#edittypePrintEmbro').val(response.type_print);
                $('#editprintingDetail').val(response.printingDetail);
                $('#editlayoutTarp').val(response.tarpLayout);
                $('#editproductId').val(response.customerId);
                $('#editmugprice').val(response.productPromo);
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
                $('#editpayment').val(response.payment);
                
                //Show/Hide Tshirt Printing Related
                if (response.type_order == 'T-shirt Printing') {
                    $('#edittypePrintEmbro, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge, #editprintingDetail').show();
                    $('#edittypePrintEmbroLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel, #editprintingDetailLabel').show();  
                    
                    $('#editcommonQuantity').hide();
                    $('#editcommonQuantityLabel').hide();
                } else {
                    $('#edittypePrintEmbro, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge, #editprintingDetail').hide();
                    $('#edittypePrintEmbroLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel, #editprintingDetailLabel').hide();
                    $('#editcommonQuantity').show();
                    $('#editcommonQuantityLabel').show()
                }
    
                //Show/Hide Plate Number Related
                if (response.type_order == 'Plate Number') {
                    $('#editplate_number, #editplatenumPrice').show();
                    $('#editplate_numberLabel, #editplatenumPriceLabel').show();

                    $('#editcommonQuantity').show();
                    $('#editcommonQuantityLabel').show();
                    
                } else {
                    $('#editplate_number, #editplatenumPrice').hide();
                    $('#editplate_numberLabel, #editplatenumPriceLabel').hide();
                }

                //Show/Hide ID Related
                if (response.type_order == 'ID') {
                    $('#editproductId').show();
                    $('#editproductIdLabel').show();
                    
                } else {
                    $('#editproductId').hide();
                    $('#editproductIdLabel').hide();
                }

                //Show/Hide Tarpalin Size Related
                if (response.type_order == 'Tarpaulin') {
                    $('#edittarpaulinSize, #editlayoutTarp').show();
                    $('#edittarpaulinSizeLabel, #editlayoutTarpLabel').show();
                    
                } else {
                    $('#edittarpaulinSize, #editlayoutTarp').hide();
                    $('#edittarpaulinSizeLabel, #editlayoutTarpLabel').hide();
                }

                //Show/Hide Mug Related
                if (response.type_order == 'Mug printing') {
                    $('#editmugprice').show();
                    $('#editmugpriceLabel').show();
                    
                } else {
                    $('#editmugprice').hide();
                    $('#editmugpriceLabel').hide();
                }
                    
                $('#editOrder-modal').modal('show');
                $('#editExistingOrder').data('id', id);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        // Datepicker initialization
        $(function() {
            $("#editdateDeadline, #editdateOrdered").datepicker({
                dateFormat: 'DD, d MM, yy'
            });
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
            editprintingDetail: $('#editprintingDetail').val(),
            editdateDeadline: $('#editdateDeadline').val(),
            editorderStatus: $('#editorderStatus').val(),
            editcommonQuantity: $('#editcommonQuantity').val(),
            editplate_number: $('#editplate_number').val(),
            editplatenumPrice: $('#editplatenumPrice').val(),
            edittarpaulinSize: $('#edittarpaulinSize').val(),
            editlayoutTarp: $('#editlayoutTarp').val(),
            editmugprice: $('#editmugprice').val(),
            editproductId: $('#editproductId').val(),
            editxsmall: $('#editxsmall').val(),
            editsmall: $('#editsmall').val(),
            editmedium: $('#editmedium').val(),
            editlarge: $('#editlarge').val(),
            editxlarge: $('#editxlarge').val(),
            edit2xlarge: $('#edit2xlarge').val(),
            edit3xlarge: $('#edit3xlarge').val(),
            edit4xlarge: $('#edit4xlarge').val(),
            editdateOrdered: $('#editdateOrdered').val(),
            editstaffName: $('#editstaffName').val(),
            editpayment: $('#editpayment').val()
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
                    title: "Cant Update Order",
                    html: response.message
                });
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error Updating Order');
        }
    });
    // Datepicker initialization
    $(function() {
        $("#editdateDeadline, #editdateOrdered").datepicker({
            dateFormat: 'DD, d MM, yy'
        });
    });
});


    });
    // Event listener for order selection change
    $('#editorder').change(function() {
        if ($(this).val() == 'T-shirt Printing') {
            $('#edittypePrintEmbro, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge, #editprintingDetail').show();
            $('#edittypePrintEmbroLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel, #editprintingDetailLabel').show();
            
            $('#editcommonQuantity').hide();
            $('#editcommonQuantityLabel').hide();

        } else {
            $('#edittypePrintEmbro, #editxsmall, #editsmall, #editmedium, #editlarge, #editxlarge, #edit2xlarge, #edit3xlarge, #edit4xlarge, #editprintingDetail').hide();
            $('#edittypePrintEmbroLabel, #editxsmallLabel, #editsmallLabel, #editmediumLabel, #editlargeLabel, #editxlargeLabel, #edit2xlargeLabel, #edit3xlargeLabel, #edit4xlargeLabel, #editprintingDetailLabel').hide();

        }
    });

    // Event listener for order Plate Number selection change
    $('#editorder').change(function() {
        if ($(this).val() == 'Plate Number') {
            $('#editplate_number, #editcommonQuantity').show();
            $('#editplate_numberLabel, #editcommonQuantityLabel').show();
        } else {
            $('#editplate_number').hide();
            $('#editplate_numberLabel').hide();
        }
    });

    // Event listener for order Tarpaulin selection change
    $('#editorder').change(function() {
        if ($(this).val() == 'Tarpaulin') {
            $('#edittarpaulinSize, #editlayoutTarp').show();
            $('#edittarpaulinSizeLabel, #editlayoutTarpLabel').show();
        } else {
            $('#edittarpaulinSize, #editlayoutTarp').hide();
            $('#edittarpaulinSizeLabel, #editlayoutTarpLabel').hide();
        }
    });

    // Event listener for order Mug printing selection change
    $('#editorder').change(function() {
        if ($(this).val() == 'Mug printing') {
            $('#editmugprice').show();
            $('#editmugpriceLabel').show();
        } else {
            $('#editmugprice').hide();
            $('#editmugpriceLabel').hide();
        }
    });
    
});


// Function to toggle inputs based on order type
function toggleInputs() {
    var jobRole = $("#add-order").val();
    var tshirtPrintingInputs = $("#tshirtPrintingInputs");
    var platenumberinput = $("#platenumberinput");
    var tarpaulinInput = $("#tarpaulinInput");
    var commonQuantityInput = $("#commonQuantityInput");
    var costItemInput = $("#costItemInput");
    var TarpLayoutInput = $("#TarpLayoutInput");
    var productIdInput = $("#productIdInput");
    var platenumPriceInput = $("#platenumPriceInput");
    var mugpriceInput = $("#mugpriceInput");
    
    // Hide/show inputs based on selected order type
    if (jobRole === "T-shirt Printing") {
        tshirtPrintingInputs.show();
        platenumberinput.hide();
        tarpaulinInput.hide();
        commonQuantityInput.hide();
        costItemInput.hide();
        TarpLayoutInput.hide();
        platenumPriceInput.hide();
        productIdInput.hide();
        mugpriceInput.hide();
    } else if (jobRole === "Plate Number") {
        tshirtPrintingInputs.hide();
        platenumberinput.show();
        tarpaulinInput.hide();
        commonQuantityInput.show();
        platenumPriceInput.show();
        costItemInput.hide();
        TarpLayoutInput.hide();
        productIdInput.hide();
        mugpriceInput.hide();
    } else if (jobRole === "Tarpaulin") {
        tshirtPrintingInputs.hide();
        platenumberinput.hide();
        tarpaulinInput.show();
        commonQuantityInput.show();
        costItemInput.hide();
        platenumPriceInput.hide();
        TarpLayoutInput.show();
        productIdInput.hide();
        mugpriceInput.hide();
    } else if (jobRole === "ID") {
        tshirtPrintingInputs.hide();
        platenumberinput.hide();
        tarpaulinInput.hide();
        commonQuantityInput.show();
        costItemInput.hide();
        productIdInput.show();
        TarpLayoutInput.hide();
        platenumPriceInput.hide();
        mugpriceInput.hide();
    } else if (jobRole === "Mug printing") {
        tshirtPrintingInputs.hide();
        platenumberinput.hide();
        tarpaulinInput.hide();
        commonQuantityInput.show();
        costItemInput.hide();
        productIdInput.hide();
        TarpLayoutInput.hide();
        platenumPriceInput.hide();
        mugpriceInput.show();
    } else if (jobRole === "Sticker") {
        tshirtPrintingInputs.hide();
        platenumberinput.hide();
        tarpaulinInput.hide();
        commonQuantityInput.show();
        costItemInput.show();
        productIdInput.hide();
        TarpLayoutInput.hide();
        platenumPriceInput.hide();
        mugpriceInput.hide();
    } else {
        // Hide all inputs if none of the options match
        tshirtPrintingInputs.hide();
        platenumberinput.hide();
        tarpaulinInput.hide();
        commonQuantityInput.show();
        costItemInput.hide();
        TarpLayoutInput.hide();
        productIdInput.hide();
        platenumPriceInput.hide();
        mugpriceInput.hide();
        costItemInput.hide();
    }
}

// Function to toggle "Other" type shirt input
function hidesize() {
    var printingDetail = $("#printingDetail").val();
    var inputXsmall = $("#hidesizeOptional");

    // Show/hide "Other" type shirt input based on selection
    if (printingDetail === "T-shirt with Print Dryfit White" || printingDetail === "Poloshirt with print Dryfit White" || printingDetail === "Poloshirt with print Cotton White" || printingDetail === "Poloshirt with print Cotton Colored") {
        inputXsmall.hide();
    } else {
        inputXsmall.show();
    }
}


