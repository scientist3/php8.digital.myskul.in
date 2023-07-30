<div class="row">
	<!--  Search Filter -->
	<div class="col-sm-12">

		<div class="card card-outline card-info">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-search"></i> <?php echo display('select_criteria'); ?></h3>
			</div>
			<div class="card-body">
				<?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success"> <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
				<form role="form" action="<?php echo site_url('dashboard_org/userlog/index') ?>" method="post" class="" id="user_search_form">
					<?php //echo $this->customlib->getCSRF(); 
					?>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label><?php echo display('designation'); ?></label> <small class="req"> *</small>
								<?php echo form_dropdown('user_role', $designation, $user_role/*$this->session->userdata('site_id') */, 'class="form-control select2bs4" id="user_role" '); ?>
								<span class="text-danger"><?php echo form_error('user_role'); ?></span>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label><?php echo display('cluster'); ?></label> <small class="req"> *</small>
								<?php echo form_dropdown('cluster_id', $cluster_list, $cluster_id/*$this->session->userdata('site_id') */, 'class="form-control select2bs4" id="cluster_id" '); ?>
								<span class="text-danger"><?php echo form_error('cluster_id'); ?></span>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<label><?php echo display('center'); ?></label> <small class="req"> *</small>
								<?php echo form_dropdown('center_id', $center_list, $center_id/*$this->session->userdata('site_id') */, 'class="form-control" id="center_id" '); ?>
								<span class="text-danger"><?php echo form_error('center_id'); ?></span>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<label><?php echo display('date'); ?></label> <small class="req"> *</small>
								<input name="date" class="form-control " type="date" placeholder="<?php echo display('date') ?>" id="date" value="<?php echo $date ?>">
								<span class="text-danger"><?php echo form_error('center_id'); ?></span>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo display('search'); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="card card-outline card-info">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-list"></i> <?php echo $title; ?></h3>
			</div>
			<div class="card-body">
				<table id="userTable" class="datatable_server table table-bordered table-striped">
					<thead>
						<tr>
							<th>Picture</th>
							<th>Name</th>
							<th>Date</th>
							<th>Login Time</th>
							<th>Logout Time</th>
							<th>User Role</th>
							<th>Action</th>
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

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})
		$('#userTable').DataTable({
			serverSide: true, // Enable server-side processing
			ajax: {
				url: '<?php echo base_url('api/v1/organisation/usersListWithParemsAsJson ') ?>', // Replace with your server API endpoint
				type: 'POST', // Use 'POST' or 'GET' based on your server implementation
				data: function(d) {
					// Add any additional parameters for filtering (if needed)
					d.cluster_id = $('#cluster_id').val();
					d.center_id = $('#center_id').val();
					d.user_role = $('#user_role').val();
					d.date = $('#date').val();
					d.page = (d.start / d.length) + 1; // Calculate the current page number
				}
			},
			columns: [
				// Define your columns here
				{
					data: 'picture',
					title: 'Picture',
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
					data: 'log.date',
					title: 'Date',
				},
				{
					data: 'log.login_time',
					title: 'Log in',
					render: function(data, type, row) {
						return "<?php echo isset($log->login_time) ? date('h:m a', strtotime($log->login_time)) : 'N/A'; ?>";
					}
				},
				{
					data: 'log.logout_time',
					title: 'Log out',
					render: function(data, type, row) {
						return "<?php echo isset($log->logout_time) ? date('h:m a', strtotime($log->logout_time)) : 'N/A'; ?>";
					}
				},
				{
					data: 'user_role',
					title: 'Designation',
					render: function(data, type, row) {
						var userrolelist = JSON.parse(JSON.stringify(<?php echo json_encode($user_role_list); ?>));
						return userrolelist[data];
					}
				},
				{
					data: 'user_id',
					title: 'Actions',
					render: function(data, type, row) {
						// Customize the content of the cell
						var viewLink = '<?php echo base_url("dashboard_org/userlog/view/") ?>' + data;
						return '<a href="' + viewLink + '" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>';
					}
				}
			],
			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>tp",
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
			"lengthChange": true,
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			], // Customize the number of records per page
			pageLength: 10, // Set the default number of records per page
			responsive: true, // Enable responsive features
		});

	});
</script>