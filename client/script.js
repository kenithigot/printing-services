$(document).ready(function () {
    var table = $('#client-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-client.php", // URL to fetch data from
            "type": "POST" // Using POST method to fetch data
        },
        "columns": [ 
            { "data": "client_name" },
            { "data": "address" },
            { "data": "contact_number" },
            { "data": "email" },
            { 
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-primary role-btn">Edit</button>' +
                        '<button class="btn btn-danger role-btn ms-2">Delete</button>';
                }
            }
        ]
    });
});

