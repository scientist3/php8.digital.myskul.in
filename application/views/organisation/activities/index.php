<style>
	/* Adjust the width as needed */
	.actions-column {
		width: 83px;
		/* Set the desired width here */
	}

	#userTable tbody tr {
		cursor: pointer;
	}
</style>
<!--Filter-->
<div class="row d-none">
	<div class="col-sm-12">
		<form role="form" action="<?php echo site_url('coordinator/cstudent/index') ?>" method="post" class="">
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
<!--Table-->
<div class="row">
	<div class="col-sm-12">
		<div class="card card-primary card-outline card-outline-tabs">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-list"></i> Student Session Completion Approval</h3>
			</div>
			<div class="card-body">
				<form role="form" action="<?php echo site_url('coordinator/cactivities/submitForSessionApprove') ?>" method="post" class="">
					<!-- Display not submitted students here -->
					<table class="datatable_new table table-bordered table-striped table-hovers">
						<thead>
							<tr>
                                <th><?php echo display('cluster') ?></th>
                                <th><?php echo display('center') ?></th>
								<th><?php echo display('total_student') ?></th>
								<th><?php echo display('session_in_approval') ?></th>
								<th><?php echo display('session_approved') ?></th>
								<th><?php echo display('cncp_in_approval') ?></th>
								<th><?php echo display('cncp_approved') ?></th>
								<th><?php echo display('cncp_supported_in_approval') ?></th>
								<th><?php echo display('cncp_supported_approved') ?></th>
                                <th><?php echo display('pyscho_educated_in_approval') ?></th>
                                <th><?php echo display('pyscho_educated_approved') ?></th>
                                <th><?php echo display('primary_counselling_in_approval') ?></th>
                                <th><?php echo display('primary_counselling_approved') ?></th>
                                <th><?php echo display('secondary_counselling_in_approval') ?></th>
                                <th><?php echo display('secondary_counselling_approved') ?></th>
                                <th><?php echo display('pyscho_social_well_being_in_approval') ?></th>
                                <th><?php echo display('pyscho_social_well_being_approved') ?></th>
                                <th><?php echo display('care_plan_in_approval') ?></th>
                                <th><?php echo display('care_plan_approved') ?></th>
							</tr>
						</thead>
						<tbody>
							<!-- User data rows will be dynamically generated here -->
							<?php if (!empty($activities_statistics)) { ?>
								<?php $sl = 1; ?>
								<?php foreach ($activities_statistics as $activities) { ?>

									<tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                                        <td><?php echo $activities->cluster_name ?></td>
                                        <td><?php echo $activities->center_name ?></td>
                                        <td><?php echo $activities->total_students ?></td>
										<td><?php echo $activities->session_in_approval ?></td>
										<td><?php echo $activities->session_approved ?></td>
										<td><?php echo $activities->cncp_in_approval ?></td>
										<td><?php echo $activities->cncp_approved ?></td>
										<td><?php echo $activities->cncp_supported_in_approval ?></td>
										<td><?php echo $activities->cncp_supported_approved ?></td>
										<td><?php echo $activities->psycho_educated_in_approval ?></td>
                                        <td><?php echo $activities->psycho_educated_approved ?></td>
                                        <td><?php echo $activities->primary_counselling_in_approval ?></td>
                                        <td><?php echo $activities->primary_counselling_approved ?></td>
                                        <td><?php echo $activities->secondary_counselling_in_approval ?></td>
                                        <td><?php echo $activities->secondary_counselling_approved ?></td>
                                        <td><?php echo $activities->well_being_in_approval ?></td>
                                        <td><?php echo $activities->well_being_approved ?></td>
                                        <td><?php echo $activities->care_plan_in_approval ?></td>
                                        <td><?php echo $activities->care_plan_approved ?></td>
									</tr>
									<?php $sl++; ?>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Include jQuery library -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
        $('.datatable_new').DataTable({
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
            "responsive": false,
            "scrollX": true, // Enable horizontal scrolling
            "dom":
                "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>" +
                "t" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "buttons": [
                {
                    extend: 'copy',
                    title: 'Example File',
                    className: 'btn-sm',

                },
                {
                    extend: 'csv',
                    title: 'Example File',
                    className: 'btn-sm',

                },
                {
                    extend: 'excel',
                    title: 'Example File',
                    className: 'btn-sm',
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Example File',
                    className: 'btn-sm',
                    pageSize: 'A4',
                    orientation: 'landscape', // Set the PDF orientation to landscape

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
                    title: 'Example File',
                    className: 'btn-sm',

                },
                {
                    extend: "colvis",
                    className: 'btn-sm',
                }
            ]
        }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');
	});
</script>