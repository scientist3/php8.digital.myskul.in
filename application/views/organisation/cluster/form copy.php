<div class="row">
	<!--  form area -->
	<div class="col-md-4">
		<?php echo form_open_multipart('organisation/ccluster/create', 'class="form-inner"') ?>
		<?php echo form_hidden('cluster_id', $input->clusterId); ?>
		<div class="card card-outline card-info">

			<div class="card-header ">
				<h3 class="card-title"><i class="fa fa-search"></i> <?php echo display('select_criteria'); ?></h3>
				<!-- <div class="btn-group">
					<a class="btn btn-primary" href="< ?php echo base_url("dashboard_org/cluster") ?>"> <i class="fa fa-list"></i> < ?php echo display('list_cluster') ?> </a>
				</div> -->
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">

						<div class="form-group">
							<label><?php echo display('cluster'); ?></label> <small class="req"> *</small>
							<div class="col-xs-9">
								<input name="cluster_name" type="text" class="form-control" id="cluster_name" placeholder="<?php echo display('cluster') ?>" value="<?php echo $input->clusterName ?>">
							</div>
						</div>

						<!-- <div class="form-group row">
                                <label for="cluster_org_id" class="col-xs-3 col-form-label"><?php echo display('org') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('cluster_org_id', $org_list, $cluster->cluster_org_id, 'class="form-control" id="cluster_org_id" readonly'); ?>
                                </div>
                            </div> -->

						<div class="form-group ">
							<label><?php echo display('coodinator'); ?></label> <small class="req"> *</small>
							<div class="col-xs-9">
								<?php echo form_dropdown('cluster_head_id', $coodinator_list, $input->clusterHeadId, 'class="form-control" id="cluster_head_id" '); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="float-right">
					<button type="reset" class="btn btn-info "><?php echo display('reset') ?></button>
					<button tyep="submit" class="btn  btn-primary"><?php echo display('save') ?></button>
				</div>
			</div>
		</div>
		<?php echo form_close() ?>
	</div>
	<!-- List Clusters -->
	<div class="col-md-8">
		<div class="card card-outline card-info">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-list"></i> <?php echo $title; ?></h3>
			</div>

			<?php //echo "<pre>"; print_r($clusters[0]); echo "</pre>"; 
			?>
			<div class="card-body">
				<table class="datatable_cluster table table-striped table-bordered table-hover">
					<thead>
						<th><?php echo display('serial') ?></th>
						<th><?php echo display('cluster') ?></th>
						<th><?php echo display('org') ?></th>
						<th><?php echo display('coodinator') ?></th>
						<th><?php echo display('action') ?></th>
					</thead>
					<tbody>
						<?php if (!empty($clusters)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($clusters as $cluster) { ?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $cluster->cluster_name; ?></td>
									<td><?php echo $cluster->org_name; ?></td>
									<td><?php echo $cluster->firstname; ?></td>
									<td class="center" width="80">
										<a href="<?php echo base_url("dashboard_org/cluster/edit/$cluster->cluster_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url("dashboard_org/cluster/delete/$cluster->cluster_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
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
		$('.datatable_cluster').DataTable({
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
						columns: [1, 2, 3, 4, 5]
					},
				},
				{
					extend: 'csv',
					title: '<?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
					className: 'btn-sm',
					exportOptions: {
						columns: [1, 2, 3, 4, 5]
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
