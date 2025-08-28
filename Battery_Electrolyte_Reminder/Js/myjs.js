//  $(document).ready(function() {
//         $('#DataTable').DataTable();
        
//     });
 $(document).ready(function() {
    $('#DataTable').DataTable({
        dom: 'Blfrtip', // "l" = length menu, "B" = buttons
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ], // Options for dropdown
        buttons: [
            'copy',
            {
                extend: 'csvHtml5',
                title: 'My CSV Data'
            },
            {
                extend: 'excelHtml5',
                title: 'My Excel Data'
            },
                {
                extend: 'pdfHtml5',
                title: 'My PDF Data',
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

