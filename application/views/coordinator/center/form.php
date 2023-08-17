<div class="row">
	<!--  form area -->
	<div class="col-sm-12 col-md-4">
		<?php echo form_open_multipart('coordinator/ccenter/create', 'class="form-inner"') ?>
		<?php echo form_hidden('center_id', $center->center_id); ?>
		<?php echo form_hidden('center_cluster_id', $center->center_cluster_id); ?>
		<div class="card card-outline card-primary">

			<div class="card-header">
				<h3 class="card-title">
					<i class="fa fa-list"></i> <?php echo $left_title; ?>
				</h3>
			</div>
			<div class="card-body">

				<div class="row">

					<div class="col-sm-12">
						<div class="form-group">
							<label for="center_name">
								<?php echo display('center_name') ?> <i class="text-danger">*</i>
							</label>

							<input name="center_name" type="text" class="form-control form-control-sm" id="center_name" placeholder="<?php echo display('center_name') ?>" value="<?php echo $center->center_name ?>">

						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="center_cluster_id">
								<?php echo display('cluster') ?> <i class="text-danger">*</i>
							</label>
							<?php echo form_dropdown('center_cluster_id', $cluster_list, $center->center_cluster_id, 'class="form-control" id="center_cluster_id" disabled'); ?>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="center_head_id">
								<?php echo display('animator') ?> <i class="text-danger">*</i>
							</label>
							<?php echo form_dropdown('center_head_id', $animator_list, $center->center_head_id, 'class="form-control" id="center_head_id" '); ?>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="center_type_id">
								<?php echo display('center_type') ?> <i class="text-danger">*</i>
							</label>
							<?php echo form_dropdown('center_type_id', $center_type, $center->center_type_id ?? NULL, 'class="form-control" id="center_type_id" '); ?>
						</div>
					</div>

				</div>
			</div>
			<div class="card-footer">
				<div class="float-right">
					<a href="<?php echo base_url('/'); ?>coordinator/ccenter/create" class="btn btn-danger <?php echo (isset($show_cancel_btn) && $show_cancel_btn) ? '' : 'd-none'; ?>"><?php echo display('Cancel') ?></a>
					<button tyep="submit" class="btn  btn-primary"><?php echo display('save') ?></button>
				</div>
			</div>
		</div>
		<?php echo form_close() ?>
	</div>

	<!-- Center List -->
	<div class="col-sm-12 col-md-8">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fa fa-plus"></i> <?php echo $right_title ?>
				</h3>
			</div>

			<?php //echo "<pre>"; print_r($centers[0]); echo "</pre>"; 
			?>
			<div class="card-body">
				<table class="datatable_center table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>
								<?php echo display('serial') ?>
							</th>
							<th>
								<?php echo display('center_name') ?>
							</th>
							<th>
								<?php echo display('cluster') ?>
							</th>
							<th>
								<?php echo display('animator') ?>
							</th>
							<th>
								<?php echo display('center_type') ?>
							</th>
							<!-- <th><?php echo display('date') ?></th>
														<th><?php echo display('status') ?></th>  -->
							<th>
								<?php echo display('action') ?>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($centers)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($centers as $center) { ?>
								<tr>
									<td>
										<?php echo $sl; ?>
									</td>
									<td>
										<?php echo $center->center_name; ?>
									</td>
									<td>
										<?php echo $center->cluster_name; ?>
									</td>
									<td>
										<?php echo $center->firstname; ?>
									</td>
									<td>
										<?php echo CenterTypes::getTypeName($center->center_type_id); ?>
									</td>
									<td class="center" width="80">
										<a href="<?php echo base_url("coordinator/ccenter/edit/$center->center_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url("coordinator/ccenter/delete/$center->center_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php $sl++; ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table> <!-- /.table-responsive -->
			</div>
		</div>
	</div>

</div>
<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<!-- <script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->

<!-- DataTables -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.datatable_center').DataTable({
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
			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>tp",
			buttons: [{
					extend: 'copy',
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
					className: 'btn-sm',
					exportOptions: {
						columns: [0, 1, 2, 3]
					},
				},
				{
					extend: 'csv',
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
					className: 'btn-sm',
					exportOptions: {
						columns: [0, 1, 2, 3]
					},
				},
				{
					extend: 'excel',
					title: 'ExampleFile',
					className: 'btn-sm',
					title: 'exportTitle'
				},
				{
					extend: 'pdfHtml5',
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
					className: 'btn-sm',
					pageSize: 'A4',
					orientation: 'portrait', // Set the PDF orientation to landscape
					exportOptions: {
						columns: [0, 1, 2, 3]
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
					className: 'btn-sm',
					exportOptions: {
						columns: [1, 2, 3, 4, 5]
					}
				},
				// {
				// 	extend: "colvis",
				// 	className: 'btn-sm',
				// }
			]
		}).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');
	});
</script>
