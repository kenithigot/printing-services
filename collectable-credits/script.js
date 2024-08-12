$(document).ready(function () {
    var table = $('#credits-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-collectable_credits.php",
            "type": "POST"
        },
        "columns": [
            { "data": "client" }, // Assuming the ID field is in the first column
            { "data": "type_order" },
            { "data": "productPrice" },
            { "data": "payment" },
            { "data": "date_ordered" },
            { "data": "order_status" },
            { "data": "staff" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return'<button class="btn btn-success ms-2 doneTaskBtn" data-id="' + row.id + '">Done Task</button>';
                }
            }
        ],
        "order": [[0, 'desc']] // Order by ID in descending order
    });

    // Add Order button click event handler
    $('#add-credits-btn').on('click', function () {
        // Clear DataTable before adding new data
        table.clear().draw();

        // Extract data from modal form fields
        var item = $('#add-client').val();
        var quantity = $('#add-type_order').val();
        var date = $('#add-productPrice').val();
        var price = $('#add-payment').val();
        var price = $('#add-date_ordered').val();
        var price = $('#add-order_status').val();
        var price = $('#add-staff').val();

        // Add new item to DataTable
        var newItem = {
            "client": client,
            "type_order": type_order,
            "productPrice": productPrice,
            "payment": payment,
            "date_ordered": date_ordered,
            "order_status": order_status,
            "staff": staff

        };
        table.row.add(newItem).draw(false);
    });

    // Reset button click event handler
    $('#resetTableBtn').on('click', function () {
        // Clear DataTable
        table.clear().draw();
    });

    // Event delegation to handle "Done Task" button clicks
    $('#credits-table').on('click', '.doneTaskBtn', function () {
        var button = $(this);
        var id = button.data('id');
        $.ajax({
            url: 'db-collectable_credits.php', // Update with your actual PHP file name
            type: 'POST',
            data: {
                id: id,
                payment: 'Paid'
            },
            success: function (response) {
                // Check if update was successful (assumes your PHP file returns a success message)
                if (response.success) {
                    // Update the DataTable row to reflect the change
                    var row = table.row(button.closest('tr'));
                    var data = row.data();
                    data.payment = 'Paid'; // Update payment status
                    row.data(data).draw();
                } else {
                    alert('Failed to update payment status.');
                }
            },
            error: function () {
                alert('An error occurred while updating payment status.');
            }
        });
    });
});
    







   




 


