<style>
    .btn-secondary:not(:disabled):not(.disabled).active,
    .btn-secondary:not(:disabled):not(.disabled):active,
    .show>.btn-secondary.dropdown-toggle {
        color: #fff;
        background-color: #4490db;
        border-color: #4e555b;
    }
</style>

<div class="row">
	<!--  form area -->
	<div class="col-sm-12 col-md-4">
		<?php echo form_open_multipart('animator/cgroups/create', 'class="form-inner"') ?>
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fa fa-plus"></i> <?php echo $left_title; ?>
				</h3>
			</div>
			<div class="card-body">
				<?php echo form_hidden('g_id', $group->g_id); ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="group_name">
								<?php echo display('group_name') ?> <i class="text-danger">*</i>
							</label>
							<input name="group_name" type="text" class="form-control form-control-sm" id="group_name" placeholder="<?php echo display('group_name') ?>" value="<?php echo $group->group_name ?>">
						</div>
					</div>
                    <!-- status-->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="mobile"><?php echo display('status') ?> <i class="text-danger">*</i></label>
                            <div class="btn-group btn-group-toggle form-control" data-toggle="buttons" style="border: none;padding: 0;">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="status" value="0" <?php echo ($group->status == 0)?'checked':'';?>><?php echo display('disabled') ?>
                                </label>
                                <label class="btn btn-secondary active">
                                    <input type="radio" name="status" value="1" <?php echo ($group->status == 1)?'checked':''; ?>><?php echo display('enabled') ?>
                                </label>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="card-footer">
				<div class="float-right">
					<a href="<?php echo base_url('/'); ?>animator/cgroups/create" class="btn btn-danger <?php echo (isset($show_cancel_btn) && $show_cancel_btn) ? '' : 'd-none'; ?>"><?php echo display('cancel') ?></a>
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
					<i class="fa fa-list"></i> <?php echo $right_title ?>
				</h3>
			</div>
			<div class="card-body">
				<table class="datatable_center table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>
								<?php echo display('serial') ?>
							</th>
							<th>
								<?php echo display('group_name') ?>
							</th>
							<th>
								<?php echo display('status') ?>
							</th>
							<th>
								<?php echo display('action') ?>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($groups)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($groups as $group) { ?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $group->group_name; ?></td>
									<td>
                                        <span class="badge <?php echo $group->status == 1 ? 'bg-success':'bg-danger';?>"><?php echo $group->status == 1 ? 'Enabled':'Disabled';?></span>
									</td>
									<td class="center" width="80">
										<a href="<?php echo base_url("animator/cgroups/edit/$group->g_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url("animator/cgroups/delete/$group->g_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
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
			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-group'B><'col-sm-4'f>>tp",
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
						// Align header and body rows to group
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

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
	});
</script>
