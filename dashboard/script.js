$(document).ready(function () {
    var table = $('#order-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "order-table.php",
            "type": "POST"
        },
        "columns": [
            { 
                "data": null,
                "render": function (data, type, row, meta) {
                    // 'meta.row' contains the row index.
                    // Increment the row index and return it as the order number.
                    return meta.row + 1;
                }
            },
            { "data": "productPrice" },
            { "data": "payment" },
            { "data": "product" },
            { "data": "date_ordered" },
        ],
        "order": [[0, 'asc']]
    });
});