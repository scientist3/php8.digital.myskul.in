<div class="row">
	<div class="col-sm-12">
		<form role="form" action="<?php echo site_url('animator/stakeholder/index') ?>" method="post" class="">
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
					<a class="btn btn-info" href="<?php echo base_url("animator/stakeholder/processStudentForm") ?>">
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
						<?php if (!empty($stakeholders)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($stakeholders as $user) { ?>
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
			</div>
		</div>
	</div>
</div>

<!-- Include jQuery library -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

	});
</script>
