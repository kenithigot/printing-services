$(document).ready(function () {
    var table = $('#jobOrder-table').DataTable({
        "searching": true,
        "ajax": {
            "url": "db-jobOrder.php",
            "type": "POST"
        },
        "columns": [
            { "data": "staffName" },
            { "data": "jobRole" },
            { "data": "staffName" },
            { "data": "staffName" },
            {
                "data": "imagePictureLink",
                "render": function (data, type, row) {
                    var truncatedText = data.length > 20 ? data.substr(0, 20) + '...' : data;
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
                            buttonClass = 'btn-primary';
                            buttonText = 'Started';
                            break;
                        case 'Not yet started':
                            buttonClass = 'btn-warning';
                            buttonText = 'Not yet started';
                            break;
                        case 'Ongoing':
                            buttonClass = 'btn-info';
                            buttonText = 'Ongoing';
                            break;
                        case 'Completed':
                            buttonClass = 'btn-success';
                            buttonText = 'Completed';
                            break;
                    }
                    return '<button class="btn ' + buttonClass + ' orderStatusBtn" data-id="' + row.id + '">' + buttonText + '</button>';
                }
            },
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

    // Navigate to the link when clicked
    $(document).on('click', '.truncate-text', function() {
        var fullText = $(this).data('fulltext');
        window.open(fullText, '_blank');
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