<div class="row">
	<div class="col-md-3">
		<a href="<?php echo base_url("coordinator/message/new_message") ?>" class="btn btn-primary btn-block mb-3"><?php echo display('new_message') ?></a>

		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Folders</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="card-body p-0">
				<ul class="nav nav-pills flex-column">
					<li class="nav-item ">
						<a href="<?php echo base_url("coordinator/message/index") ?>" class="nav-link <?php echo $inbox_option ?? null; ?>">
							<i class="fas fa-inbox"></i> Inbox
							<span class="badge bg-primary float-right"><?php echo count($received_emails); ?></span>
						</a>
					</li>
					<li class="nav-item ">
						<a href="<?php echo base_url("coordinator/message/sent") ?>" class="nav-link <?php echo $sent_option ?? null; ?>">
							<i class="far fa-envelope"></i> Sent
						</a>
					</li>

				</ul>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
		<div class="card d-none">
			<div class="card-header">
				<h3 class="card-title">Labels</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="card-body p-0">
				<ul class="nav nav-pills flex-column">
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="far fa-circle text-danger"></i>
							Important
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="far fa-circle text-warning"></i> Promotions
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="far fa-circle text-primary"></i>
							Social
						</a>
					</li>
				</ul>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.col -->
	<div class="col-md-9">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title"><?php echo display('inbox') ?></h3>

				<div class="card-tools">
					<div class="input-group input-group-sm d-none">
						<input id="customSearchBox" type="text" class="form-control" placeholder="Search Mail">
						<div class="input-group-append">
							<div class="btn btn-primary">
								<i class="fas fa-search"></i>
							</div>
						</div>
					</div>
				</div>
				<!-- /.card-tools -->
			</div>
			<!-- /.card-header -->
			<div class="card-body ">
				<div class="mailbox-controls d-none">
					<!-- Check all button -->
					<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
					</button>
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm">
							<i class="far fa-trash-alt"></i>
						</button>
						<button type="button" class="btn btn-default btn-sm">
							<i class="fas fa-reply"></i>
						</button>
						<button type="button" class="btn btn-default btn-sm">
							<i class="fas fa-share"></i>
						</button>
					</div>
					<!-- /.btn-group -->
					<button type="button" class="btn btn-default btn-sm">
						<i class="fas fa-sync-alt"></i>
					</button>
					<div class="float-right">
						1-50/200
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm">
								<i class="fas fa-chevron-left"></i>
							</button>
							<button type="button" class="btn btn-default btn-sm">
								<i class="fas fa-chevron-right"></i>
							</button>
						</div>
						<!-- /.btn-group -->
					</div>
					<!-- /.float-right -->
				</div>
				<div class="table-responsive mailbox-messages">
					<table class="simpledatatable table table-hover table-striped">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($received_emails)) { ?>
								<?php foreach ($received_emails as $message) { ?>
									<tr>
										<td>
											<div class="icheck-primary">
												<input type="checkbox" value="" id="check1">
												<label for="check1"></label>
											</div>
										</td>
										<!--                    <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>-->
										<td class="mailbox-name">
											<?php echo ($message->receiver_status == 0) ? '<b>' : ''; ?>
											<a href="<?php echo base_url("coordinator/message/inbox_information/$message->id/$message->sender_id") ?>">
												<?php echo $message->sender_firstname; ?>
											</a>
											<?php echo ($message->receiver_status == 0) ? '</b>' : ''; ?>
										</td>
										<td class="mailbox-subject">
											<?php echo ($message->receiver_status == 0) ? '<b>' : ''; ?>
											<?php echo character_limiter(strip_tags($message->message), 20); ?>
											<?php echo ($message->receiver_status == 0) ? '</b>' : ''; ?>
										</td>
										<!--                    <td class="mailbox-attachment"></td>-->
										<td class="mailbox-date"><?php echo time_elapsed_string($message->datetime); ?></td>
										<td><?php echo (($message->receiver_status == 0) ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>'); ?></td>
									</tr>
								<?php } ?>
							<?php } ?>


						</tbody>
					</table>
					<!-- /.table -->
				</div>
				<!-- /.mail-box-messages -->
			</div>
			<!-- /.card-body -->
			<div class="card-footer p-0 d-none">
				<div class="mailbox-controls">
					<!-- Check all button -->
					<button type="button" class="btn btn-default btn-sm checkbox-toggle">
						<i class="far fa-square"></i>
					</button>
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm">
							<i class="far fa-trash-alt"></i>
						</button>
						<button type="button" class="btn btn-default btn-sm">
							<i class="fas fa-reply"></i>
						</button>
						<button type="button" class="btn btn-default btn-sm">
							<i class="fas fa-share"></i>
						</button>
					</div>
					<!-- /.btn-group -->
					<button type="button" class="btn btn-default btn-sm">
						<i class="fas fa-sync-alt"></i>
					</button>
					<div class="float-right">
						1-50/200
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm">
								<i class="fas fa-chevron-left"></i>
							</button>
							<button type="button" class="btn btn-default btn-sm">
								<i class="fas fa-chevron-right"></i>
							</button>
						</div>
						<!-- /.btn-group -->
					</div>
					<!-- /.float-right -->
				</div>
			</div>
		</div>
		<!-- /.card -->
	</div>
	<!-- /.col -->
</div>

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		/*$('.datatable').DataTable({
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
		        title: '< ?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
		        className: 'btn-sm',
		        exportOptions: {
		            columns: [1, 2, 3, 4, 5]
		        },
		    },
		        {
		            extend: 'csv',
		            title: '< ?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
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
		            title: '< ?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
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
		            title: '< ?php echo isset($pdfFileName) ? $pdfFileName : 'Example File'; ?>',
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
		*/

		var dataTable = $('.simpledatatable').DataTable({
			"paging": true,
			"lengthChange": true,
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"pagingType": "simple", // Add pagination type for "prev" and "next" buttons
			// dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>tp",
			// buttons: [
			//     // Your export buttons configuration here
			// ]
		})
	});
</script>
