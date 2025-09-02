//  $(document).ready(function() {
//         $('#DataTable').DataTable();
        
//     });
 $(document).ready(function() {
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
                title: '<?php echo $pagename ?? "System" ?>'
            },
            {
                extend: 'excelHtml5',
                title: '<?php echo $pagename ?? "System" ?>'
            },
                {
                extend: 'pdfHtml5',
                title: '<?php echo $pagename ?? "System" ?>',
                orientation: 'portrait',  // or 'landscape'
                pageSize: 'A4',           // A4, A3, Letter, etc.
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
