// // Function to initialize the DataTable with server-side processing
// function initializeDataTable() {
//     $('#userTable').DataTable({
//         serverSide: true, // Enable server-side processing
//         deferRender: true, // Defer rendering of rows for better performance
//         dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t" +
//             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
//         ajax: {
//             url: '<?php echo base_url('api/v1/organisation/usersListWithParemsAsJson ') ?>',
//             type: 'POST',
//             data: function(d) {
//                 d.check = "P";
//                 d.cluster_id = $('#cluster_id').val();
//                 d.center_id = $('#center_id').val();
//                 d.user_role = $('#user_role').val();
//                 d.date = $('#date').val();
//                 d.page = (d.start / d.length) + 1;
//             }
//         },
//         // Columns and other options...
//     });
// }

// $(document).ready(function() {
//     $('.select2bs4').select2({
//         theme: 'bootstrap4'
//     });

//     // Call the function to initialize DataTable on page load
//     initializeDataTable();

//     $('#user_role, #cluster_id, #center_id, #date').on('change', function() {
//         // Use ajax.reload() to reload the table data without destroying and recreating the table
//         $('#userTable').DataTable().ajax.reload();
//     });

//     // Handle the form submission to reinitialize DataTable with new search data
//     $('#user_search_form').on('submit', function(event) {
//         event.preventDefault();
//         // Use ajax.reload() to reload the table data without destroying and recreating the table
//         $('#userTable').DataTable().ajax.reload();
//     });

//     // Bind the reinitializeDataTable function to the window resize event with a delay
//     let resizeTimeout = null;
//     $(window).on('resize', function() {
//         // Clear the previous timeout to avoid unnecessary reinitialization
//         clearTimeout(resizeTimeout);
//         // Set a new timeout to reinitialize DataTable after resizing is complete
//         resizeTimeout = setTimeout(function() {
//             // Use draw() to redraw the table without destroying and recreating the table
//             $('#userTable').DataTable().draw();
//         }, 500); // Adjust the delay (in milliseconds) according to your preference
//     });
// });

// // Function to initialize the DataTable with server-side processing
// 	function initializeDataTable() {
// 		$('#userTable').DataTable({
// 			serverSide: true, // Enable server-side processing
// 			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t" +
// 				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
// 			ajax: {
// 				url: '<?php echo base_url('api/v1/organisation/usersListWithParemsAsJson ') ?>', // Replace with your server API endpoint
// 				type: 'POST', // Use 'POST' or 'GET' based on your server implementation
// 				data: function(d) {
// 					// Add any additional parameters for filtering (if needed)
// 					d.check = "P";
// 					d.cluster_id = $('#cluster_id').val();
// 					d.center_id = $('#center_id').val();
// 					d.user_role = $('#user_role').val();
// 					d.date = $('#date').val();
// 					d.page = (d.start / d.length) + 1; // Calculate the current page number
// 				}
// 			},
// 			columns: [
// 				// Define your columns here
// 				{
// 					data: 'picture',
// 					title: 'Picture',
// 					render: function(data, type, row) {
// 						// Customize the content of the cell
// 						var imageUrl = data ? '<?php echo base_url("' + data + '") ?>' : '<?php echo base_url("assets/images/no_image.png") ?>';
// 						return '<img src="' + imageUrl + '" alt="Picture" class="img-thumbnail img-responsive" height="50px" width="50px">';
// 					}
// 				},
// 				{
// 					data: 'firstname',
// 					title: 'Name'
// 				},
// 				{
// 					data: 'log.date',
// 					title: 'Date',
// 				},
// 				{
// 					data: 'log.login_time',
// 					title: 'Log in',
// 					render: function(data, type, row) {
// 						debugger;
// 						return (data != '') ? data : 'N/A';
// 					}
// 				},
// 				{
// 					data: 'log.logout_time',
// 					title: 'Log out',
// 					render: function(data, type, row) {
// 						return (data != '') ? data : 'N/A';
// 					}
// 				},
// 				{
// 					data: 'user_role',
// 					title: 'Designation',
// 					render: function(data, type, row) {
// 						var userrolelist = JSON.parse(JSON.stringify(<?php echo json_encode($user_role_list); ?>));
// 						return userrolelist[data];
// 					}
// 				},
// 				{
// 					data: 'user_id',
// 					title: 'Actions',
// 					render: function(data, type, row) {
// 						// Customize the content of the cell
// 						var viewLink = '<?php echo base_url("organisation/cattendance/view/") ?>' + data;
// 						return '<a href="' + viewLink + '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>';
// 					}
// 				}
// 			],
// 			buttons: [{
// 					extend: 'copy',
// 					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
// 					className: 'btn-sm', // Add the btn-sm class for small button
// 					exportOptions: {
// 						columns: [1, 2, 3, 4, 5]
// 					},
// 				},
// 				{
// 					extend: 'csv',
// 					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
// 					className: 'btn-sm', // Add the btn-sm class for small button
// 					exportOptions: {
// 						columns: [1, 2, 3, 4, 5]
// 					},
// 				},
// 				{
// 					extend: 'excel',
// 					title: 'ExampleFile',
// 					className: 'btn-sm', // Add the btn-sm class for small button
// 					title: 'exportTitle'
// 				},
// 				{
// 					extend: 'pdfHtml5',
// 					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
// 					className: 'btn-sm', // Add the btn-sm class for small button
// 					pageSize: 'A4',
// 					orientation: 'portrait', // Set the PDF orientation to landscape
// 					exportOptions: {
// 						columns: [1, 2, 3, 4, 5]
// 					},
// 					customize: function(doc) {
// 						// Adjust font size
// 						doc.defaultStyle.fontSize = 10;

// 						// Use autoTable to adjust column widths
// 						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
// 						// Align header and body rows to center
// 						doc.content[1].table.body.forEach(function(row) {
// 							row.forEach(function(cell) {
// 								cell.alignment = 'left';
// 							});
// 						});
// 					}
// 				},
// 				{
// 					extend: "print",
// 					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
// 					className: 'btn-sm', // Add the btn-sm class for small button
// 					exportOptions: {
// 						columns: [1, 2, 3, 4, 5]
// 					}
// 				},
// 				{
// 					extend: "colvis",
// 					className: 'btn-sm', // Add the btn-sm class for small button
// 				}
// 			],
// 			// Add pagination options
// 			paging: true,
// 			lengthChange: true,
// 			lengthMenu: [
// 				[7, 10, 25, 50, -1],
// 				[7, 10, 25, 50, "All"]
// 			], // Customize the number of records per page
// 			pageLength: 7, // Set the default number of records per page
// 			responsive: true, // Enable responsive features
// 			order: [
// 				[1, 'asc']
// 			]
// 		});
// 	}
// 	// Function to clear and reinitialize DataTable after window resize event is complete
// 	function reinitializeDataTable() {
// 		// Clear the previous timeout to avoid unnecessary reinitialization
// 		if (typeof resizeTimeout !== 'undefined' && resizeTimeout !== null) {
// 			clearTimeout(resizeTimeout);
// 		}
// 		// Set a new timeout to reinitialize DataTable after resizing is complete
// 		resizeTimeout = setTimeout(function() {
// 			// Clear the table before reinitializing
// 			$('#userTable').DataTable().clear().destroy();
// 			initializeDataTable(); // Reinitialize DataTable
// 		}, 500); // Adjust the delay (in milliseconds) according to your preference
// 	}

// 	$(document).ready(function() {
// 		$('.select2bs4').select2({
// 			theme: 'bootstrap4'
// 		})
// 		// Call the function to initialize DataTable on page load
// 		initializeDataTable();
// 		$('#user_role, #cluster_id, #center_id, #date').on('change', function() {
// 			event.preventDefault(); // Prevent form submission

// 			// Clear the table before reinitializing
// 			$('#userTable').DataTable().clear().destroy();

// 			// Call the function to initialize DataTable with the new search data
// 			initializeDataTable();
// 		});
// 		// Handle the form submission to reinitialize DataTable with new search data
// 		$('#user_search_form').on('submit', function(event) {
// 			event.preventDefault(); // Prevent form submission

// 			// Clear the table before reinitializing
// 			$('#userTable').DataTable().clear().destroy();

// 			// Call the function to initialize DataTable with the new search data
// 			initializeDataTable();
// 		});

// 		// Bind the reinitializeDataTable function to the window resize event
// 		$(window).on('resize', reinitializeDataTable);
// 	});

