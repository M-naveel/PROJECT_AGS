

$(document).ready(function() {
    
    var title_name = $("#title").text();
    
    
    $('#DataTable').DataTable({
        
        
        language: {
            emptyTable: "No batteries found for the selected date range"
        },
        dom: 'Blfrtip', // "l" = length menu, "B" = buttons
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ], // Options for dropdown
        buttons: [
            'copy',
            {
                extend: 'csvHtml5',
                title: title_name
            },
            {
                extend: 'excelHtml5',
                title: title_name
            },
                {
                extend: 'pdfHtml5',
                title: title_name,
                orientation: 'portrait',  // or 'landscape'
                
                Size: 'A4',           // A4, A3, Letter, etc.
                exportOptions: {
                    columns: ':visible'   // Export only visible columns
                }
            },
            'print'
             
        ]
    });
});

// button end here
// for edit button on the battery record page

// Index.php fuction to call the modal box
document.getElementById('Notificationbell').addEventListener('click', function (e) {
    e.preventDefault(); // prevent page reload if <a href="#">
    var alertModal = new bootstrap.Modal(document.getElementById('batteryAlertModal'));
    alertModal.show();
});

// function to automatically correct the code  for the phone Number 
$(document).ready(function () {
    $("#Phone_Number").on("blur", function () {
        let val = $(this).val().trim();

        // If user typed only digits and not starting with +92
        if (/^[0-9]{10,11}$/.test(val)) {
            $(this).val("+92" + val.replace(/^0/, "")); 
        }

        // If user typed 0 at start (like 0300...) → convert
        else if (/^0[0-9]{9,10}$/.test(val)) {
            $(this).val("+92" + val.substring(1));
        }
    });
});