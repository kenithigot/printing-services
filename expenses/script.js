$(document).ready(function () {
    var table = $('#expenses-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-expenses.php",
            "type": "POST"
        },
        "columns": [ 
            { "data": "date" },
            { "data": "item" },
            { "data": "category" },
            { "data": "amount" },
            { 
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary editExpensesbtn" data-bs-toggle="modal" data-bs-target="#edit-client" data-id="' + row.id + '">Edit</button>' +
                        '<button class="btn btn-danger ms-2 deleteExpenses-btn" data-id="' + row.id + '">Delete</button>';
                }
            }
        ],
        "order": [[0, 'asc']]
    });

  
    // Edit Client Info
    $(document).on('click', '.editExpensesbtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: 'editexpenses.php',
            type: 'POST',
            data: { id },
            dataType: 'json',
            success: function (response) {

                // Populate the modal with data
                $('#date').val(response.date);
                $('#item').val(response.item);
                $('#category').val(response.category);
                $('#amount').val(response.amount);

                // Show the modal
                $('#edit-expenses').modal('show');

                // Store the id in a data attribute of the update button
                $('#updateExpenses').data('id', id);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Update Client Info
    $('#updateExpenses').click(function () {
        var id = $(this).data('id');

        // Get the form data
        var formData = {
            id: id,
            date: $('#date').val(),
            item: $('#item').val(),
            category: $('#category').val(),
            amount: $('#amount').val()
        };

        $.ajax({
            url: 'updateexpenses.php',
            type: 'POST',
            data: formData,
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
            error: function () {
                alert('Error updating expenses');
            }
        });
    }); 

    // Delete Client Info
    $(document).on('click', '.deleteExpenses-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this client data!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'deleteexpenses.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: "success",
                                title: "Successfully Deleted!",
                                text: "User Data Deleted successfully."
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Failed to delete user data."
                            });
                        }
                    },
                    error: function () {
                        alert('Error deleting expenses');
                    }
                });
            }
        });
    });
    // Datepicker initialization script
    $(function() {
        $("#add-date").datepicker({
            dateFormat: 'DD, d MM, yy'
        });
    });
        // Datepicker initialization script
        $(function() {
            $("date").datepicker({
                dateFormat: 'DD, d MM, yy'
            });
        });
});

