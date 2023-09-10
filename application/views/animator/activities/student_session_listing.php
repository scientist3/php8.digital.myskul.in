<style>
	.dataTables_wrapper .sorting_asc:first-child::before,
	.dataTables_wrapper .sorting_desc:first-child::before,
	.dataTables_wrapper .sorting:first-child::before,
	.dataTables_wrapper .sorting_asc:first-child::after,
	.dataTables_wrapper .sorting_desc:first-child::after,
	.dataTables_wrapper .sorting:first-child::after {
		content: "";
		display: none;
	}

	th.sorting_disabled.sorting_asc {
		cursor: default !important;
	}
</style>
<!--Filter-->
<div class="row d-none">
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
<!--Table-->
<div class="row">
	<div class="col-sm-12">
		<div class="card card-primary card-outline card-outline-tabs">
			<div class="card-header p-0 border-bottom-0">
				<!-- Create tabs for different student statuses -->
				<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="custom-tabs-for-all-students-tab" data-toggle="pill" href="#custom-tabs-for-all-students" role="tab" aria-controls="custom-tabs-for-all-students" aria-selected="true">All Students</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="custom-tabs-for-not-submitted-tab" data-toggle="pill" href="#custom-tabs-for-not-submitted" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Not Submitted</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="custom-tabs-for-pending-tab" data-toggle="pill" href="#custom-tabs-for-pending" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Pending Approval</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="custom-tabs-for-approved-tab" data-toggle="pill" href="#custom-tabs-for-approved" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Completed/Approved</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content" id="custom-tabs-four-tabContent">
					<div class="tab-pane fade active show" id="custom-tabs-for-all-students" data-category="session_status" data-status="0,1,2" role="tabpanel" aria-labelledby="custom-tabs-for-all-students-tab">
						<!-- Display all students here -->
						<table id="userTableAll" class="datatable_new table table-bordered table-striped table-hovers">
							<thead>
								<tr>
									<th>#</th>
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
										<tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
											<td><?php echo $sl; ?></td>
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
					</div>
					<div class="tab-pane fade" id="custom-tabs-for-not-submitted" data-category="session_status" data-status="0" role="tabpanel" aria-labelledby="custom-tabs-for-not-submitted-tab">
						<form role="form" action="<?php echo site_url('animator/cactivities/submitForSessionApproval') ?>" method="post" class="">
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
											<?php if ($user->session_status != 0) continue; ?>
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
							<button id="submitForApproval" type="submit" class="btn btn-primary  float-right "><i class="fa fa-edit"></i> <?php echo display('submit_for_approval'); ?></button>
						</form>
					</div>
					<div class="tab-pane fade" id="custom-tabs-for-pending" data-category="session_status" data-status="1" role="tabpanel" aria-labelledby="custom-tabs-for-pending-tab">
						<!-- Display pending students here -->
						<table id="userTablePending" class="datatable_new table table-bordered table-striped table-hovers">
							<thead>
								<tr>
									<th>#</th>
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
										<?php if ($user->session_status != 1) continue; ?>
										<tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">

											<td><?php echo $sl; ?></td>
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
					</div>
					<div class="tab-pane fade" id="custom-tabs-for-approved" data-category="session_status" data-status="2" role="tabpanel" aria-labelledby="custom-tabs-for-approved-tab">
						<!-- Display approved students here -->
						<table id="userTableApproved" class="datatable_new table table-bordered table-striped table-hovers">
							<thead>
								<tr>
									<th>#</th>
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
										<?php if ($user->session_status != 2) continue; ?>
										<tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
											<td><?php echo $sl; ?></td>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="base_url" value="<?php echo base_url("/") ?>">
<input type="hidden" id="pdf_name" value="<?php echo $pdfFileName ?? 'Example File' ?>">
<!-- Include jQuery library -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url('assets/js/activities_new.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
        // Not used now may need later
		/*$('#submitForApproval').on('click', function(e) {
			e.preventDefault();

			var selectedStudents = $('.js-student-not-enrolled:checked', '#userTableNotSubmitted');
            var selectedStudentIds = [];
            selectedStudents.each(function() {
                selectedStudentIds.push($(this).val());
            });
            $.ajax({
                url: '<?php echo site_url('animator/cactivities/submitForSessionApproval') ?>',
                type: 'POST',
                data: {
                    students: selectedStudentIds
                },
                success: function(response) {
                    // Handle the server response here
                    window.location.reload();

                },
                error: function(error) {
                    alert('Error sending selected students to the server.');
                    window.location.reload();
                }
            });
		});*/
	});
</script>