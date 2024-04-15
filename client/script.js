$(document).ready(function () {
    var table = $('#client-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-client.php",
            "type": "POST"
        },
       
    });

    $('#userRoleSelect').on('change', function () {
        var selectedRole = $(this).val();
        if (selectedRole === 'all') {
            table.column(3).search('').draw();
        } else {
            table.column(3).search(selectedRole).draw(); 
        }
    });
});