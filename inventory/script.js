
$(document).ready(function() {
    $(".editable").on('click', function() {
        $(this).attr('contenteditable', 'true');
        $(this).focus();
    });

    $(".editable").on('blur', function() {
        var category = $(this).data('category');
        var size = $(this).data('size');
        var newValue = $(this).text();

        $.ajax({
            type: 'POST',
            url: 'save_data.php',
            data: {
                category: category,
                size: size,
                newValue: newValue
            },
            success: function(response) {
                // Handle success message or further operations
                console.log(response);

                Swal.fire({
                icon: 'success',
                title: 'Data Saved',
                text: 'Your changes have been saved successfully!',
                }).then(function() {
                // Redirect to the next page
                window.location.href = '../inventory/';
            });
            }
        });
    });
});

$(document).ready(function() {
    $('#mugQuantityInput').on('change', function() {
        var newQuantity = $(this).val();
        var id = 1; // Change this to the correct ID you're updating

        $.ajax({
            url: 'mug-save_data.php',
            type: 'POST',
            data: { newQuantity: newQuantity, id: id }, // Include any other parameters needed
            success: function(response) {
                if (response === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Saved',
                        text: 'Your changes have been saved successfully!',
                    }).then(function() {
                        // Redirect to the next page
                        window.location.href = '../inventory/';
                    });
                } else {
                    alert("Error updating mug quantity.");
                }
            },
            error: function() {
                alert("Error updating mug quantity. Please try again.");
            }
        });
    });
});

