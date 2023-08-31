$(document).ready(function() {
	const base_url  = $('#base_url').val();
	const userTable = $('#userTable');
	const clusterId = $('#cluster_id');
	const centerId = $('#center_id');
	const error = $('#error');
	const dummy_image = base_url+ 'assets/images/no_image.png'
	let resizeTimeout;
	
	// Initialize DataTable and fetch center options
	initializeDataTable();
	
	// Function to handle row click event
	function viewStudent(userId) {
		if (!$(event.target).hasClass('fa') && !$(event.target).hasClass('dtr-control')) {
			window.location.href = base_url+'animator/cstudent/profile/' + userId;
		}
	}
	
	// Initialize DataTable
	function initializeDataTable() {
		userTable.DataTable().clear().destroy();
		userTable.DataTable({
			rowCallback: function(row, data, index) {
				$(row).on('click', function() {
					if (!$(event.target).hasClass('actions-column')) {
						viewStudent(data.user_id);
					}
				});
			},
			serverSide: true,
			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			ajax: {
					url: base_url+'api/v1/organisation/studentListWithParemsAsJson',
				type: 'POST',
				data: function(d) {
					d.cluster_id = clusterId.val();
					d.center_id = centerId.val();
					d.user_role = 5;
					d.date = $('#date').val();
					d.page = (d.start / d.length) + 1;
				}
			},
			columns: [
			// Define your columns here
			{
				data: 'picture',
				title: 'Serial ',
				render: function(data, type, row) {
					// Customize the content of the cell
					var imageUrl = data ? base_url + data  : dummy_image;
					return '<img src="' + imageUrl + '" alt="Picture" class="img-thumbnail img-responsive" height="50px" width="50px">';
				}
			},
			{
				data: 'firstname',
				title: 'Name'
			},
			{
				data: 'mobile',
				title: 'Mobile',
			},
			{
				data: 'email',
				title: 'Email',
			},
			{
				data: 'district',
				title: 'District',
			},
			{
				data: 'sex',
				title: 'Gender',
			},
			{
				data: 'age',
				title: 'Age Group',
			},
			{
				data: 'org_name',
				title: 'Organisation',
			},
			{
				data: 'cluster_name',
				title: 'Cluster',
			},
			{
				data: 'center_name',
				title: 'Center',
			},
			{
				data: 'user_id',
				title: 'Actions',
				className: 'actions-column', // Add this class
				render: function(data, type, row) {
					// Customize the content of the cell
					var viewLink = base_url + 'animator/cstudent/profile/' + data;
					var editLink = base_url + 'animator/cstudent/edit/' + data;
					var deleteLink = base_url + 'animator/cstudent/stddelete/' + data;
					html = '<a href="' + viewLink + '" class="btn btn-xs btn-success mr-1"><i class="fa fa-eye"></i></a>';
					html += '<a href="' + editLink + '" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>';
					html += '<a href="' + deleteLink + '" class="btn btn-xs btn-danger" onclick="return confirm(\'Are You Sure\')"><i class="fa fa-trash"></i></a>';
					
					return html;
				}
			}
		],
			buttons: [
			{
				extend: 'copy',
				title: pdf_name ,
				className: 'btn-sm', // Add the btn-sm class for small button
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
			},
			{
				extend: 'csv',
				title:  pdf_name ,
				className: 'btn-sm', // Add the btn-sm class for small button
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
			},
			{
				extend: 'excel',
				title: 'ExampleFile',
				className: 'btn-sm', // Add the btn-sm class for small button
				title: 'exportTitle'
			},
			{
				extend: 'pdfHtml5',
				title:  pdf_name ,
				className: 'btn-sm', // Add the btn-sm class for small button
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
				title:  pdf_name ,
				className: 'btn-sm', // Add the btn-sm class for small button
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				}
			},
			{
				extend: "colvis",
				className: 'btn-sm', // Add the btn-sm class for small button
			}
		],
			paging: true,
			lengthChange: true,
			lengthMenu: [
			[7, 10, 25, 50, -1],
			[7, 10, 25, 50, "All"]
		],
			pageLength: 7,
			responsive: true,
			order: [
			[1, 'asc']
		]
		});
	}
	
	// Event handler for cluster and center select changes
	clusterId.add(centerId).on('change', function(event) {
		event.preventDefault();
		initializeDataTable();
	});
	
	// Fetch center options using AJAX
	function fetchCenterOptions(clusterIdValue) {
		$.ajax({
			url: base_url + 'animator/cstudent/center_by_cluster/',
			type: 'post',
			dataType: 'json',
			data: {
				cluster_id: clusterIdValue
			},
			success: function(data) {
				const optionsHtml = (data.status === true) ? data.message : '<option value="">Select Center</option>';
				updateCenterOptions(centerId, optionsHtml);
				error.html('');
			},
			error: function() {
				alert('Failed to fetch center options.');
			}
		});
	}
	
	// Update center select options
	function updateCenterOptions(selectElement, optionsHtml) {
		selectElement.html(optionsHtml);
	}
	
	// Trigger the change event on page load
	// clusterId.trigger('change');
	// fetchCenterOptions(clusterId.val());
});
