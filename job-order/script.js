$(document).ready(function () {
    var table = $('#jobOrder-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-jobOrder.php",
            "type": "POST"
        },
        "columns": [
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary editJoborderBtn" data-bs-toggle="modal" data-bs-target="#viewJobOrder-modal" data-id="' + row.id + '">View</button>' 
                        
                }
            },
            { "data": "staffName" },
            { "data": "jobRole" },
            { "data": "dateDeadline" },
            {
                "data": "imagePictureLink",
                "render": function (data, type, row) {
                    var truncatedText = data.length > 30 ? data.substr(0, 30) + '...' : data;
                    return '<span class="truncate-text" data-fulltext="' + data + '" title="' + data + '">' + truncatedText + '</span>';
                }
            },
            {
                "data": null,
                "render": function (data, type, row) {
                    var buttonClass = '';
                    var buttonText = '';
                    switch (row.orderStatus) {
                        case 'Started':
                            buttonClass = 'fw-bold';
                            buttonText = 'Started';
                            break;
                        case 'Not yet started':
                            buttonClass = 'fw-bold';
                            buttonText = 'Not started';
                            break;
                        case 'Ongoing':
                            buttonClass = 'fw-bold';
                            buttonText = 'Ongoing';
                            break;
                        case 'Completed':
                            buttonClass = 'fw-bold';
                            buttonText = 'Completed';
                            break;
                    }
                    return '<button class="btn ' + buttonClass + ' orderStatusBtn" data-id="' + row.id + '">' + buttonText + '</button>';
                }
            },
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<button type="button" class="btn btn-primary editTaskBtn" data-bs-toggle="modal" data-bs-target="#editTaskModal" data-id="' + row.id + '">Edit</button>' +
                           '<button class="btn btn-success ms-2 doneTaskBtn" data-id="' + row.id + '">Done Task</button>';
                }
            }
        ],
           
        "order": [[0, 'asc']]
    });

    // Navigate to the link when clicked
    $(document).on('click', '.truncate-text', function() {
        var fullText = $(this).data('fulltext');
        window.open(fullText, '_blank');
    });

    // Datepicker initialization script
    $(function() {
        $("dateDeadline").datepicker({
            dateFormat: 'DD, d MM, yy'
        });
    });

    // View Task of Job Order
$(document).on('click', '.editJoborderBtn', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

    $.ajax({
        url: 'selectJobOrder.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response) {
                // Populate the labels with data
                $('#view-jobRole').text(response.jobRole);
                $('#view-typePrintEmbro').text(response.typePrintEmbro);
                $('#view-typeShirt').text(response.typeShirt);
                $('#view-typeShirtOther').text(response.typeShirtOther);
                $('#view-typeCloth').text(response.typeCloth);

                // Show the modal
                $('#viewJobOrder-modal').modal('show');

               // Hide labels if no data available
                if (!response.jobRole) {
                    $('#view-jobRole').parent().hide();
                } else {
                    $('#view-jobRole').parent().show();
                    if (response.jobRole !== 'T-shirt Printing') {
                        $('#view-typePrintEmbro').parent().hide();
                        $('#view-typeShirt').parent().hide();
                        $('#view-typeShirtOther').parent().hide();
                        $('#view-typeCloth').parent().hide();
                    } else {
                        if (!response.typePrintEmbro) $('#view-typePrintEmbro').parent().hide();
                        else $('#view-typePrintEmbro').parent().show();

                        if (!response.typeShirt) $('#view-typeShirt').parent().hide();
                        else $('#view-typeShirt').parent().show();

                        if (!response.typeShirtOther) $('#view-typeShirtOther').parent().hide();
                        else $('#view-typeShirtOther').parent().show();

                        if (!response.typeCloth) $('#view-typeCloth').parent().hide();
                        else $('#view-typeCloth').parent().show();
                    }
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

  
    //Edit Task Order
    $(document).on('click', '.editTaskBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
    
        $.ajax({
            url: 'selectJobOrder.php',
            type: 'POST',
            data: {id:id },
            dataType: 'json',
            success: function (response) {
                $('#staffName').val(response.staffName); 
                $('#jobRole').val(response.jobRole);
                $('#typePrintEmbro').val(response.typePrintEmbro);
                $('#typeCloth').val(response.typeCloth);
                $('#typeShirt').val(response.typeShirt);
                $('#typeShirtOther').val(response.typeShirtOther);
                $('#imagePictureLink').val(response.imagePictureLink);
                $('#dateDeadline').val(response.dateDeadline);
                $('#orderStatus').val(response.orderStatus);
    
                // Show or hide related fields based on job role
                if (response.jobRole === 'T-shirt Printing') {
                    $('#typePrintEmbro, #typeCloth, #typeShirt').show();
                    // Show the labels
                    $('label[for="typePrintEmbro"], label[for="typeCloth"], label[for="typeShirt"] ').show();
                } else {
                    $('#typePrintEmbro, #typeCloth, #typeShirt').hide();
                    // Hide the labels
                    $('label[for="typePrintEmbro"], label[for="typeCloth"], label[for="typeShirt"]').hide();
                }

                // Show or hide "Applicable for Type of Shirt [Other]" input based on "Type of Shirt" select
                if (response.typeShirt === 'Other') {
                    $('#typeShirtOther').show();
                    $('label[for="typeShirtOther"]').show();
                } else {
                    $('#typeShirtOther').hide();
                    $('label[for="typeShirtOther"]').hide();
                }
    
                $('#editTaskModal').modal('show');
    
                $('#saveTaskOrder').data('id', id);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        // Update Task Order
        $('#saveTaskOrder').click(function () {
            var id = $(this).data('id');

            // Get the form data
            var OrderData = {
                id: id,
                staffName: $('#staffName').val(),
                jobRole: $('#jobRole').val(),
                typePrintEmbro: $('#typePrintEmbro').val(),
                typeCloth: $('#typeCloth').val(),
                typeShirt: $('#typeShirt').val(),
                typeShirtOther: $('#typeShirtOther').val(),
                imagePictureLink: $('#imagePictureLink').val(),
                dateDeadline: $('#dateDeadline').val(),
                orderStatus: $('#orderStatus').val()
            };

            $.ajax({
                url: 'updateOrder.php',
                type: 'POST',
                data: OrderData,
                dataType: 'json',
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Successfully Updated!",
                        text: "User Data Updated successfully."
                    }).then(function () {
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error Updating Task');
                }
            });
        });
    });

    // Event listener for job role change
    $('#jobRole').change(function() {
        var selectedJobRole = $(this).val();
    
        if (selectedJobRole !== 'T-shirt Printing') {
            $('#typePrintEmbro, #typeCloth, #typeShirt, #typeShirtOther').hide();
            // Hide the labels
            $('label[for="typePrintEmbro"], label[for="typeCloth"], label[for="typeShirt"], label[for="typeShirtOther"]').hide();
        } else {
            $('#typePrintEmbro, #typeCloth, #typeShirt').show();
            // Show the labels
            $('label[for="typePrintEmbro"], label[for="typeCloth"], label[for="typeShirt"]').show();
        }
    });

    // Filter type of Shirt Others
    $('#typeShirt').change(function() {
        var selectedtypeShirt = $(this).val();
    
        if (selectedtypeShirt !== 'Other') {
            $('#typeShirtOther').hide();
            // Hide the labels
            $('label[for="typeShirtOther"]').hide();
        } else {
            $('#typeShirtOther').show();
            // Show the labels
            $('label[for="typeShirtOther"]').show();
        }
    });

    // Done Task Deletion 
    $(document).on('click', '.doneTaskBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'By clicking task done means marking the task as completed.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#157347',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Done Task'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'doneTaskOrder.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: "success",
                                title: "Done Task",
                                text: "Task completed successfully."
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Failed to delete Task Order."
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
});
    
// Datepicker initialization script
$(function() {
    $("#add-dateDeadline").datepicker({
        dateFormat: 'DD, d MM, yy'
    });
});

//Filter Job Role and Type Shirt Others
function toggleInputs() {
    var jobRole = document.getElementById("add-jobRole").value;
    var tshirtPrintingInputs = document.getElementById("tshirtPrintingInputs");
    var typeShirtOtherInput = document.getElementById("typeShirtOtherInput");

    if (jobRole === "T-shirt Printing") {
        tshirtPrintingInputs.style.display = "block";
    } else {
        tshirtPrintingInputs.style.display = "none";
        typeShirtOtherInput.style.display = "none";
    }
}

function toggleOtherInput() {
    var typeShirt = document.getElementById("add-typeShirt").value;
    var typeShirtOtherInput = document.getElementById("typeShirtOtherInput");

    if (typeShirt === "Other") {
        typeShirtOtherInput.style.display = "block";
    } else {
        typeShirtOtherInput.style.display = "none";
    }
}



   




 


