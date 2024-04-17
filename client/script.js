$(document).ready(function () {
    var table = $('#client-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-client.php",
            "type": "POST"
        },
        "columns": [ 
            { "data": "client_name" },
            { "data": "clientAddress" },
            { "data": "fb_account" },
            { "data": "email" },
            { 
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary editClientbtn" data-bs-toggle="modal" data-bs-target="#edit-client" data-id="' + row.id + '">Edit</button>' +
                        '<button class="btn btn-danger ms-2 deleteClient-btn" data-id="' + row.id + '">Delete</button>';
                }
            }
        ],
        "order": [[0, 'asc']]
    });

  
    // Edit Client Info
    $(document).on('click', '.editClientbtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: 'editclient.php',
            type: 'POST',
            data: { id },
            dataType: 'json',
            success: function (response) {

                // Populate the modal with data
                $('#client_name').val(response.client_name);
                $('#clientAddress').val(response.clientAddress);
                $('#contactNum').val(response.contactNum);
                $('#fb_account').val(response.fb_account);
                $('#email').val(response.email);

                // Show the modal
                $('#edit-client').modal('show');

                // Store the id in a data attribute of the update button
                $('#updateClient').data('id', id);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Update Client Info
    $('#updateClient').click(function () {
        var id = $(this).data('id');

        // Get the form data
        var formData = {
            id: id,
            client_name: $('#client_name').val(),
            clientAddress: $('#clientAddress').val(),
            contactNum: $('#contactNum').val(),
            fb_account: $('#fb_account').val(),
            email: $('#email').val()
        };

        $.ajax({
            url: 'updateclient.php',
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
                alert('Error updating client');
            }
        });
    }); 

    // Delete Client Info
    $(document).on('click', '.deleteClient-btn', function (e) {
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
                    url: 'deleteclient.php',
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
                        alert('Error deleting client');
                    }
                });
            }
        });
    });
});
