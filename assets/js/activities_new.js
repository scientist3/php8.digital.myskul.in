$(document).ready(function () {
	$('#userTableNotSubmitted').DataTable({
		"paging": false,
		"lengthChange": true,
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"searching": true,
		"columnDefs": [
			{
				"orderable": false,
				"targets": 0,
			} // Disable sorting on the first column (index 0)
		],
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t<'row'<'col-sm-6'i>>",
		buttons: [
			{
				extend: 'copy',
				title: 'Example File',
				className: 'btn-sm',
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
			},
			{
				extend: 'csv',
				title: 'Example File',
				className: 'btn-sm',
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
			},
			{
				extend: 'excel',
				title: 'ExampleFile',
				className: 'btn-sm',
			},
			{
				extend: 'pdfHtml5',
				title: 'Example File',
				className: 'btn-sm',
				pageSize: 'A4',
				orientation: 'portrait', // Set the PDF orientation to landscape
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
				customize: function (doc) {
					// Adjust font size
					doc.defaultStyle.fontSize = 10;

					// Use autoTable to adjust column widths
					doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					// Align header and body rows to center
					doc.content[1].table.body.forEach(function (row) {
						row.forEach(function (cell) {
							cell.alignment = 'left';
						});
					});
				}
			},
			{
				extend: "print",
				title: 'Example File',
				className: 'btn-sm',
				exportOptions: {
					columns: [2, 3, 4, 5]
				}
			},
			{
				extend: "colvis",
				className: 'btn-sm',
			}
		],
		"order": [[1, 'asc']],
		drawCallback: function () {
			var userTable = this.api();
			// Add event handler for checkboxes on the current page
			$('.js-student-not-enrolled', userTable.rows({ search: 'applied' }).nodes()).on('change', function () {
				var isChecked = $(this).prop('checked');

				// If any row-level checkbox is unchecked, uncheck the header checkbox
				if (!isChecked) {
					$('#selectAllCheckbox').prop('checked', false);
				} else {
					// Check if all row-level checkboxes on the current page are checked
					var allChecked = $('.js-student-not-enrolled:checked').length === $('.js-student-not-enrolled').length;
					$('#selectAllCheckbox').prop('checked', allChecked);
				}
			});
			if($('#selectAllCheckbox').prop('checked')){
				$('.js-student-not-enrolled').prop('checked',true)
			}else{
				$('.js-student-not-enrolled').prop('checked',false)
			}
		},
	}).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');

	$('#userTableAll, #userTablePending, #userTableApproved').DataTable({
		"paging": true,
		"lengthChange": true,
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"searching": true,

		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
		buttons: [{
			extend: 'copy',
			title: 'Example File',
			className: 'btn-sm',
			exportOptions: {
				columns: [1, 2, 3, 4, 5]
			},
		},
			{
				extend: 'csv',
				title: 'Example File',
				className: 'btn-sm',
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
			},
			{
				extend: 'excel',
				title: 'ExampleFile',
				className: 'btn-sm',
			},
			{
				extend: 'pdfHtml5',
				title: 'Example File',
				className: 'btn-sm',
				pageSize: 'A4',
				orientation: 'portrait', // Set the PDF orientation to landscape
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
				customize: function(doc) {
					// Adjust font size
					doc.defaultStyle.fontSize = 10;

					// Use autoTable to adjust column widths
					doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					// Align header and body rows to center
					doc.content[1].table.body.forEach(function(row) {
						row.forEach(function(cell) {
							cell.alignment = 'left';
						});
					});
				}
			},
			{
				extend: "print",
				title: 'Example File',
				className: 'btn-sm',
				exportOptions: {
					columns: [2, 3, 4, 5]
				}
			},
			{
				extend: "colvis",
				className: 'btn-sm',
			}
		],
	}).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');

	// Function to handle the "Select All" checkbox
	$('#selectAllCheckbox').on('change', function () {
		var isChecked = $(this).prop('checked');
		// Find all the checkboxes in the DataTable's body and set their checked status
		$('.js-student-not-enrolled',).prop('checked', isChecked);

	});
});
