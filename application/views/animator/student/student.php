<div class="row">
	<div class="col-sm-12">
		<form role="form" action="<?php echo site_url('animator/cstudent/index') ?>" method="post" class="">
			<div class="card card-outline card-primary">
				<div class="card-header with-border">
					<h3 class="card-title"><i class="fa fa-search"></i> <?php echo display('select_criteria'); ?></h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label><?php echo display('cluster'); ?></label> <small class="req"> * </small>
								<?php echo form_dropdown('cluster_id',  $cluster_list, $cluster_id, 'class="form-control" id="cluster_id" disabled'); ?>
								<span class="text-danger"><?php echo form_error('cluster_id'); ?></span>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label><?php echo display('center'); ?></label> <small class="req"> *</small>
								<?php echo form_dropdown('center_id', $center_list, $center_id, 'class="form-control" id="center_id" '); ?>
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
					<a class="btn btn-info" href="<?php echo base_url("animator/cstudent/processStudentForm") ?>">
						<i class="fa fa-plus"></i> <?php echo display('add_student') ?>
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
	$(document).ready(function() {
		const userTable = $('#userTable');
		const clusterId = $('#cluster_id');
		const centerId = $('#center_id');
		const error = $('#error');
		let resizeTimeout;

		// Call the function to initialize DataTable on page load
		initializeDataTable();

		// Initialize DataTable and fetch center options
		function initializeDataTable() {
			userTable.DataTable().clear().destroy();
			userTable.DataTable({
				serverSide: true,
				dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				ajax: {
					url: '<?php echo base_url('api/v1/organisation/studentListWithParemsAsJson ') ?>',
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
							var viewLink = '<?php echo base_url("animator/cstudent/profile/") ?>' + data;
							var editLink = '<?php echo base_url("animator/cstudent/edit/") ?>' + data;
							var deleteLink = '<?php echo base_url("animator/cstudent/stddelete/") ?>' + data;
							html = '<a href="' + viewLink + '" class="btn btn-xs btn-success mr-1"><i class="fa fa-eye"></i></a>';
							html += '<a href="' + editLink + '" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>';
							html += '<a href="' + deleteLink + '" class="btn btn-xs btn-danger" onclick="return confirm(\'Are You Sure\')"><i class="fa fa-trash"></i></a>';

							return html;
						}
					}
				],
				buttons: [{
						extend: 'copy',
						title: '<?php echo $pdfFileName ?? 'Example File'; ?>',
						className: 'btn-sm', // Add the btn-sm class for small button
						exportOptions: {
							columns: [1, 2, 3, 4, 5]
						},
					},
					{
						extend: 'csv',
						title: '<?php echo $pdfFileName ?? 'Example File'; ?>',
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
						title: '<?php echo $pdfFileName ?? 'Example File'; ?>',
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

		// Function to clear and reinitialize DataTable after window resize event is complete
		function reinitializeDataTable() {
			clearTimeout(resizeTimeout);
			resizeTimeout = setTimeout(function() {
				userTable.DataTable().clear().destroy();
				initializeDataTable();
			}, 500);
		}

		// Event handler for cluster and center select changes
		clusterId.add(centerId).on('change', function(event) {
			event.preventDefault();
			initializeDataTable();
		});

		// centerId.on('change', function() {
		// 	fetchCenterOptions(clusterId.val());
		// })
		// Fetch center options using AJAX
		function fetchCenterOptions(clusterIdValue) {
			$.ajax({
				url: "<?php echo site_url('animator/cstudent/center_by_cluster/') ?>",
				type: 'post',
				dataType: 'json',
				data: {
					'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
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
</script>
