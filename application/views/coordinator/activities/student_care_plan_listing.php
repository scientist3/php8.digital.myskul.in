<style>
    /* Adjust the width as needed */
    .actions-column {
        width: 83px; /* Set the desired width here */
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
        <form role="form" action="<?php echo site_url('coordinator/cactivities/submitForCarePlanApprove') ?>" method="post" class="">
          <!-- Display not submitted students here -->
          <table id="userTableNotSubmitted" class="datatable_new table table-bordered table-striped table-hovers">
            <thead>
            <tr>
              <th>
                <div class="form-groupp d-flex justify-content-center align-items-center">
                  <div class="select">
                    <input type="checkbox" id="selectAllCheckbox" class=" form-control ml-1 mr-1">
                  </div>
                </div>
              </th>
              <th><?php echo display('first_name') ?></th>
              <th><?php echo display('sex') ?></th>
              <th><?php echo display('mobile') ?></th>
              <th><?php echo display('email') ?></th>
              <th><?php echo display('district') ?></th>
              <th><?php echo display('age') ?></th>
              <th><?php echo display('organisation_name') ?></th>
              <th><?php echo display('cluster_name') ?></th>
              <th><?php echo display('center_name') ?></th>
            </tr>
            </thead>
            <tbody>
            <!-- User data rows will be dynamically generated here -->
			      <?php if (!empty($all_students)) { ?>
				      <?php $sl = 1; ?>
				      <?php foreach ($all_students as $user) { ?>
					      <?php if ($user->care_plan_status != 1) continue; ?>
                <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                  <td>
                    <div class="form-groupp d-flex justify-content-center align-items-center">
                      <div class="select">
                        <input name="students[]" class="js-student-not-enrolled form-control ml-1 mr-1" type="checkbox" value="<?php echo $user->user_id; ?>">
                      </div>
                    </div>
                  </td>
                  <td><?php echo ucfirst($user->firstname); ?></td>
                  <td><?php echo $user->sex; ?></td>
                  <td>
                    <div class="contact">
                      <div class="line"></div><a href="tel:+91<?php echo $user->mobile; ?>"><?php echo $user->mobile; ?></a>
                    </div>
                  </td>
                  <td><?php echo $user->email; ?></td>
                  <td><?php echo $user->district; ?></td>
                  <td><?php echo $user->age; ?></td>
                  <td><?php echo $user->org_name; ?></td>
                  <td><?php echo $user->cluster_name; ?></td>
                  <td><?php echo $user->center_name; ?></td>
                </tr>
					      <?php $sl++; ?>
				      <?php } ?>
			      <?php } ?>
            </tbody>
          </table>
          <button type="submit" class="btn btn-primary  float-right "><i class="fa fa-edit"></i>  <?php echo display('approve'); ?></button>
        </form>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="base_url" value="<?php echo base_url("/") ?>">
<input type="hidden" id="pdf_name" value="<?php echo $pdfFileName ?? 'Example File' ?>">
<!-- Include jQuery library -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<!--<script src="--><?php //echo base_url('assets/js/activities.js'); ?><!--"></script>-->
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
			"columnDefs": [{
				"orderable": false,
				"targets": 0
			} // Disable sorting on the first column (index 0)
			],
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			dom: "<'row'<'col-sm-2'l><'col-sm-6 text-center'B><'col-sm-4'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			buttons: [{
				extend: 'copy',
				title: 'Example File',
				className: 'btn-sm',
				exportOptions: {
					columns: [1, 2, 3, 4, 5]
				},
			},
				{
					extend: 'csv',
					title: 'Example File',
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
					title: 'Example File',
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
					title: 'Example File',
					className: 'btn-sm',
					exportOptions: {
						columns: [2, 3, 4, 5]
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