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

});
    
function toggleInputs() {
    var item = document.getElementById("add-item").value;
    var tarpaulin = document.getElementById("tarpaulin");
    var rushid = document.getElementById("rushid");

    if (item === "Tarpaulin") {
        tarpaulin.style.display = "block";
        rushid.style.display = "none";
    } else if (item === "Rush ID") {
        tarpaulin.style.display = "none";
        rushid.style.display = "block";
    } else {
        tarpaulin.style.display = "none";
        rushid.style.display = "none";
    }
}


function updateRushIdPrice() {
    var setSelect = document.getElementById("add-rushid");
    var setTypeSelect = document.getElementById("add-rushidType");
    var quantityInput = document.getElementById("add-quantity");
    var priceInput = document.getElementById("add-price");

    console.log("Set Option: ", setSelect.value);
    console.log("Type Option: ", setTypeSelect.value);
    console.log("Quantity: ", quantityInput.value);

    var setOption = setSelect.options[setSelect.selectedIndex].value;
    var typeOption = setTypeSelect.options[setTypeSelect.selectedIndex].value;
    var quantity = parseInt(quantityInput.value);

    // Price calculation based on selected set and type
    if ((setOption === "Set 1 5pcs. 2x2 & 4pcs. 1x1" || setOption === "Set 2 4pcs. 2x2 &8pcs. 1x1") && typeOption === "Studio Shoot") {
        priceInput.value = (quantity * 75).toFixed(2);
    } else if ((setOption === "Set 1 5pcs. 2x2 & 4pcs. 1x1" || setOption === "Set 2 4pcs. 2x2 &8pcs. 1x1") && typeOption === "Recopy") {
        priceInput.value = (quantity * 40).toFixed(2);
    } else if (setOption === "Set 3 8pcs. Passport Size" && typeOption === "Studio Shoot") {
        priceInput.value = (quantity * 95).toFixed(2);
    } else if (setOption === "Set 4 6pcs. Passport Size 3pcs. 1x1" && typeOption === "Studio Shoot") {
        priceInput.value = (quantity * 95).toFixed(2);
    } else if (setOption === "Set 3 8pcs. Passport Size" && typeOption === "Recopy") {
        priceInput.value = (quantity * 60).toFixed(2);
    } else if (setOption === "Set 4 6pcs. Passport Size 3pcs. 1x1" && typeOption === "Recopy") {
        priceInput.value = (quantity * 60).toFixed(2);
    } else if (setOption === "Set 5 ASA 4pcs. ID and 6pcs. 1x1" && typeOption === "Studio Shoot") {
        priceInput.value = (quantity * 115).toFixed(2); // Corrected the condition for Set 5
    } else if (setOption === "Set 5 ASA 4pcs. ID and 6pcs. 1x1" && typeOption === "Recopy") {
        priceInput.value = (quantity * 80).toFixed(2); // Corrected the condition for Set 5
    } else {
        priceInput.value = ""; // Clear price for other combinations
    }
}

// Attach the updateRushIdPrice function to the Rush ID select boxes and quantity input
document.getElementById("add-rushid").onchange = updateRushIdPrice;
document.getElementById("add-rushidType").onchange = updateRushIdPrice;
document.getElementById("add-quantity").addEventListener("input", updateRushIdPrice);

// Initial call to updateRushIdPrice in case there are default selections
updateRushIdPrice();




// Function to calculate the price
function calculatePrice() {
    // Get selected values and quantity
    var tarpaulinSize = document.getElementById("add-tarpaulin").value;
    var tarpaulinType = document.getElementById("add-tarpaulinType").value;
    var quantity = parseInt(document.getElementById("add-quantity").value);

    // Initialize base price and additional rush price
    var basePrice = 0;
    var rushPrice = 150;
    var additionalFootPrice = 36;

    // Define base prices for sizes up to 5x21
    var basePrices = {
        "2x3": 108,
        "2x4": 144,
        "2x5": 180,
        "2x6": 216,
        "2x7": 252,
        "2x8": 288,
        "2x9": 324,
        "2x10": 360,
        "2x11": 396,
        "2x12": 432,
        "2x13": 468,
        "2x14": 504,
        "2x15": 540,
        "2x16": 576,
        "2x17": 612,
        "2x18": 648,
        "2x19": 684,
        "2x20": 720,
        "2x21": 756,
        "2x22": 792,
        "3x3": 162,
        "3x4": 216,
        "3x5": 270,
        "3x6": 324,
        "3x7": 378,
        "3x8": 432,
        "3x9": 486,
        "3x10": 540,
        "3x11": 594,
        "3x12": 648,
        "3x13": 702,
        "3x14": 756,
        "3x15": 810,
        "3x16": 864,
        "3x17": 918,
        "3x18": 972,
        "3x19": 1026,
        "3x20": 1080,
        "3x21": 1134,
        "3x22": 1188,
        "4x2": 144,
        "4x3": 216,
        "4x4": 288,
        "4x5": 360,
        "4x6": 432,
        "4x7": 504,
        "4x8": 576,
        "4x9": 648,
        "4x10": 720,
        "4x11": 792,
        "4x12": 864,
        "4x13": 936,
        "4x14": 1008,
        "4x15": 1080,
        "4x16": 1152,
        "4x17": 1224,
        "4x18": 1296,
        "4x19": 1368,
        "4x20": 1440,
        "4x21": 1512,
        "5x2": 180,
        "5x3": 270,
        "5x4": 360,
        "5x5": 450,
        "5x6": 540,
        "5x7": 630,
        "5x8": 720,
        "5x9": 810,
        "5x10": 900,
        "5x11": 990,
        "5x12": 1080,
        "5x13": 1170,
        "5x14": 1260,
        "5x15": 1350,
        "5x16": 1440,
        "5x17": 1530,
        "5x18": 1620,
        "5x19": 1710,
        "5x20": 1800,
        "5x21": 1890,
    };

    // Check if the selected size is in the basePrices object
    if (tarpaulinSize in basePrices) {
        basePrice = basePrices[tarpaulinSize];
    } else {
        // If size is not found, default to 0
        basePrice = 0;
    }

    // Calculate total price based on tarpaulinType
    var totalPrice = basePrice;
    if (tarpaulinType === "Recopy") {
        totalPrice += rushPrice;
    }

    // Multiply total price by quantity
    totalPrice *= quantity;

    // Display the total price
    document.getElementById("add-price").value = totalPrice;

    // Display the total price element
    document.getElementById("totalPrice").textContent = "Total Price: $" + totalPrice;
}

// Attach event listener to the select elements and quantity input
document.getElementById("add-tarpaulin").addEventListener("change", calculatePrice);
document.getElementById("add-tarpaulinType").addEventListener("change", calculatePrice);
document.getElementById("add-quantity").addEventListener("input", calculatePrice);








   




 


