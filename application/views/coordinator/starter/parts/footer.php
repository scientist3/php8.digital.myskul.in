<!-- Main Footer -->
<footer class="main-footer">
	<!-- To the right -->
	<div class="float-right d-none d-sm-inline">
		Designed & Developed By Aamir Bashir
	</div>
	<!-- Default to the left -->
	<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- For Pdf botton on datatable -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/pdfmake/vfs_fonts.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/js/adminlte.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.ddatatable').DataTable({
			responsive: true,
			dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			buttons: [{
					extend: 'copy',
					className: 'btn-sm'
				},
				{
					extend: 'csv',
					title: 'ExampleFile',
					className: 'btn-sm'
				},
				{
					extend: 'excel',
					title: 'ExampleFile',
					className: 'btn-sm',
					title: 'exportTitle'
				},
				{
					extend: 'pdf',
					title: 'ExampleFile',
					className: 'btn-sm'
				},
				{
					extend: 'print',
					className: 'btn-sm'
				}
			]
		});

		$(".ddatatable").DataTable({
			"responsive": true,
			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>tp",
			"lengthChange": true,
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			"autoWidth": true,
			// "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			buttons: [{
					extend: 'copy',
					className: 'btn-sm'
				},
				{
					extend: 'csv',
					title: 'ExampleFile',
					className: 'btn-sm'
				},
				{
					extend: 'excel',
					title: 'ExampleFile',
					className: 'btn-sm',
					title: 'exportTitle'
				},
				{
					extend: 'pdf',
					title: 'ExampleFile',
					className: 'btn-sm'
				},
				{
					extend: 'print',
					className: 'btn-sm'
				}
			]
		}).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');

		$('.datatable').DataTable({
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
				{
					extend: "colvis",
					className: 'btn-sm',
				}
			]
		}).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');


	});
</script>
</body>

</html>