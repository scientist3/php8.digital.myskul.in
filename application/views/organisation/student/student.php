<div class="row">
	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-info"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
					<style>
						svg {
							fill: #ffffff
						}
					</style>
					<path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z" />
				</svg></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Students</span>
				<span class="info-box-number"><?php echo number($tot_students); ?></span>
			</div>

		</div>

	</div>

	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
					<style>
						svg {
							fill: #ffffff
						}
					</style>
					<path d="M256 64A64 64 0 1 0 128 64a64 64 0 1 0 128 0zM152.9 169.3c-23.7-8.4-44.5-24.3-58.8-45.8L74.6 94.2C64.8 79.5 45 75.6 30.2 85.4s-18.7 29.7-8.9 44.4L40.9 159c18.1 27.1 42.8 48.4 71.1 62.4V480c0 17.7 14.3 32 32 32s32-14.3 32-32V384h32v96c0 17.7 14.3 32 32 32s32-14.3 32-32V221.6c29.1-14.2 54.4-36.2 72.7-64.2l18.2-27.9c9.6-14.8 5.4-34.6-9.4-44.3s-34.6-5.5-44.3 9.4L291 122.4c-21.8 33.4-58.9 53.6-98.8 53.6c-12.6 0-24.9-2-36.6-5.8c-.9-.3-1.8-.7-2.7-.9z" />
				</svg></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Orphans</span>
				<span class="info-box-number"><?php echo number($tot_orphans); ?></span>
			</div>

		</div>

	</div>

	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-lime"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
					<style>
						svg {
							fill: #ffffff
						}
					</style>
					<path d="M192 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM120.5 247.2c12.4-4.7 18.7-18.5 14-30.9s-18.5-18.7-30.9-14C43.1 225.1 0 283.5 0 352c0 88.4 71.6 160 160 160c61.2 0 114.3-34.3 141.2-84.7c6.2-11.7 1.8-26.2-9.9-32.5s-26.2-1.8-32.5 9.9C240 440 202.8 464 160 464C98.1 464 48 413.9 48 352c0-47.9 30.1-88.8 72.5-104.8zM259.8 176l-1.9-9.7c-4.5-22.3-24-38.3-46.8-38.3c-30.1 0-52.7 27.5-46.8 57l23.1 115.5c6 29.9 32.2 51.4 62.8 51.4h5.1c.4 0 .8 0 1.3 0h94.1c6.7 0 12.6 4.1 15 10.4L402 459.2c6 16.1 23.8 24.6 40.1 19.1l48-16c16.8-5.6 25.8-23.7 20.2-40.5s-23.7-25.8-40.5-20.2l-18.7 6.2-25.5-68c-11.7-31.2-41.6-51.9-74.9-51.9H282.2l-9.6-48H336c17.7 0 32-14.3 32-32s-14.3-32-32-32H259.8z" />
				</svg></span>
			<div class="info-box-content">
				<span class="info-box-text">Total disabled</span>
				<span class="info-box-number"><?php echo number($tot_disabled); ?></span>
			</div>

		</div>

	</div>

	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-olive"><i class="fa fa-university"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total School Drop Out</span>
				<span class="info-box-number"><?php echo number($tot_drop_out); ?></span>
			</div>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-olive"><i class="fa fa-male"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Boys 6-11</span>
				<span class="info-box-number"><?php echo number($boys_6_11); ?></span>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-olive"><i class="fa fa-male"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Boys 12-18</span>
				<span class="info-box-number"><?php echo number($boys_12_18); ?></span>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-olive"><i class="fa fa-female"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Girls 6-11</span>
				<span class="info-box-number"><?php echo number($girls_6_11); ?></span>
			</div>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-olive"><i class="fa fa-female"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Girls 12-18</span>
				<span class="info-box-number"><?php echo number($girls_12_18); ?></span>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">
		<form role="form" action="<?php echo site_url('organisation/cstudent/index') ?>" method="post" class="">
			<div class="card card-outline card-primary">
				<div class="card-header with-border">
					<h3 class="card-title"><i class="fa fa-search"></i> <?php echo display('select_criteria'); ?></h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label><?php echo display('cluster'); ?></label> <small class="req"> * </small>
								<?php echo form_dropdown('cluster_id',  $cluster_list, $cluster_id/*$this->session->userdata('site_id') */, 'class="form-control" id="cluster_id" '); ?>
								<span class="text-danger"><?php echo form_error('cluster_id'); ?></span>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label><?php echo display('center'); ?></label> <small class="req"> *</small>
								<?php echo form_dropdown('center_id', ['' => 'Select Center'], $center_id/*$this->session->userdata('site_id') */, 'class="form-control" id="center_id" '); ?>
								<span class="text-danger"><?php echo form_error('center_id'); ?></span>
							</div>
						</div>

					</div>
				</div>
				<div class="card-footer d-none">
					<button type="submit" name="search" value="search_filter" class="btn btn-primary  float-right "><i class="fa fa-search"></i> <?php echo display('search'); ?></button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="row">
	<!--  table area -->
	<div class="col-sm-12">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<?php echo $PageTitle; ?>
				</h3>
				<div class="card-tools">
					<a class="btn btn-info" href="<?php echo base_url("organisation/cstudent/processStudentForm") ?>">
						<i class="fa fa-plus"></i> <?php echo display('add_student') ?>
					</a>
					<a class="btn btn-success" href="<?php echo base_url("organisation/cuser/addUser") ?>">
						<i class="fa fa-plus"></i> <?php echo display('add_member') ?>
					</a>
					<a class="btn btn-success" href="<?php echo base_url("organisation/cuser/index") ?>">
						<i class="fa fa-list"></i> <?php echo display('list_user') ?>
					</a>
				</div>

			</div>
			<?php //echo "<pre>"; print_r($users[0]); echo "</pre>"; 
			?>
			<div class="card-body">
				<table id="userTable" class="datatable_server table table-bordered table-striped table-hovers">
					<thead>
						<tr>
							<th><?php echo display('serial') ?></th>
							<th><?php echo display('first_name') ?></th>
							<th><?php echo display('mobile') ?></th>
							<th><?php echo display('email') ?></th>
							<th><?php echo display('district') ?></th>
							<th><?php echo display('sex') ?></th>
							<th><?php echo display('age') ?></th>
							<th><?php echo display('organisation_name') ?></th>
							<th><?php echo display('cluster_name') ?></th>
							<th><?php echo display('center_name') ?></th>
							<th><?php echo display('action') ?></th>
						</tr>
					</thead>
					<tbody>
						<!-- User data rows will be dynamically generated here -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Include jQuery library -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	// Function to initialize the DataTable with server-side processing
	function initializeDataTable() {
		$('#userTable').DataTable({
			serverSide: true, // Enable server-side processing
			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			ajax: {
				url: '<?php echo base_url('api/v1/organisation/studentListWithParemsAsJson') ?>', // Replace with your server API endpoint
				type: 'POST', // Use 'POST' or 'GET' based on your server implementation
				data: function(d) {
					// Add any additional parameters for filtering (if needed)
					d.check = "P";
					d.cluster_id = $('#cluster_id').val();
					d.center_id = $('#center_id').val();
					d.user_role = 5;
					d.date = $('#date').val();
					d.page = (d.start / d.length) + 1; // Calculate the current page number
				}
			},
			/* user_id, age, block, center_id, class, cluster_idd, create_date, created_by, district, email,
			father_name, father_occup, firstname, mobile, mother_name, mother_occup, org_idd,
			picture, remarks, school_level, school_name, school_status, school_type, sex, socail_status,
			status, update_date, user_role, village
			*/
			columns: [
				// Define your columns here
				{
					data: 'picture',
					title: 'Serial ',
					render: function(data, type, row) {
						// Customize the content of the cell
						var imageUrl = data ? '<?php echo base_url("' + data + '") ?>' : '<?php echo base_url("assets/images/no_image.png") ?>';
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
					render: function(data, type, row) {
						// Customize the content of the cell
						var viewLink = '<?php echo base_url("organisation/cstudent/profile/") ?>' + data;
						var editLink = '<?php echo base_url("organisation/cstudent/edit/") ?>' + data;
						var deleteLink = '<?php echo base_url("organisation/cstudent/stddelete/") ?>' + data;
						html = '<a href="' + viewLink + '" class="btn btn-xs btn-success mr-1"><i class="fa fa-eye"></i></a>';
						html += '<a href="' + editLink + '" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>';
						html += '<a href="' + deleteLink + '" class="btn btn-xs btn-danger" onclick="return confirm(\'Are You Sure\')"><i class="fa fa-trash"></i></a>';

						return html;
					}
				}
			],
			buttons: [{
					extend: 'copy',
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
					className: 'btn-sm', // Add the btn-sm class for small button
					exportOptions: {
						columns: [1, 2, 3, 4, 5]
					},
				},
				{
					extend: 'csv',
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
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
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
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
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
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
			// Add pagination options
			paging: true,
			lengthChange: true,
			lengthMenu: [
				[7, 10, 25, 50, -1],
				[7, 10, 25, 50, "All"]
			], // Customize the number of records per page
			pageLength: 7, // Set the default number of records per page
			responsive: true, // Enable responsive features
			order: [
				[1, 'asc']
			]
		});
	}
	// Function to clear and reinitialize DataTable after window resize event is complete
	function reinitializeDataTable() {
		// Clear the previous timeout to avoid unnecessary reinitialization
		if (typeof resizeTimeout !== 'undefined' && resizeTimeout !== null) {
			clearTimeout(resizeTimeout);
		}
		// Set a new timeout to reinitialize DataTable after resizing is complete
		resizeTimeout = setTimeout(function() {
			// Clear the table before reinitializing
			$('#userTable').DataTable().clear().destroy();
			initializeDataTable(); // Reinitialize DataTable
		}, 500); // Adjust the delay (in milliseconds) according to your preference
	}

	$(document).ready(function() {
		// Call the function to initialize DataTable on page load
		initializeDataTable();
		$('#cluster_id, #center_id').on('change', function() {
			event.preventDefault(); // Prevent form submission

			// Clear the table before reinitializing
			$('#userTable').DataTable().clear().destroy();

			// Call the function to initialize DataTable with the new search data
			initializeDataTable();
		});

		$("#cluster_id").change(function() {
			fetchCenterOptions($(this).val());
		});

		function fetchCenterOptions(clusterId) {
			var centerList = $('#center_id');
			var error = $('#error');

			$.ajax({
				url: "<?php echo site_url('organisation/cstudent/center_by_cluster/') ?>",
				type: 'post',
				dataType: 'json',
				data: {
					'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
					cluster_id: clusterId
				},
				success: function(data) {
					if (data.status === true) {
						updateCenterOptions(centerList, data.message);
						error.html('');
					} else {
						updateCenterOptions(centerList, '<option value="">Select Center</option>');
						// Uncomment the line below if you want to show an error message
						// error.html(data.center);
					}
				},
				error: function() {
					alert('Failed to fetch center options.');
				}
			});
		}

		function updateCenterOptions(selectElement, optionsHtml) {
			selectElement.html(optionsHtml);
		}
	});
</script>
