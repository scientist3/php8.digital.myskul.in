<div class="row">
	<!--  table area -->
	<div class="col-sm-12">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fas fa-users mr-1"></i>
					<?php echo $PageTitle; ?>
				</h3>
				<div class="card-tools">
					<a class="btn btn-success" href="<?php echo base_url("organisation/cuser/addUser") ?>">
						<i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo display('add_member') ?>
					</a>
					<a class="btn btn-info" href="<?php echo base_url("organisation/cstudent/processStudentForm") ?>">
						<i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo display('add_student') ?>
					</a>
					<a class="btn btn-info" href="<?php echo base_url("organisation/cstudent/index") ?>">
						<i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo display('list_student') ?>
					</a>
				</div>

			</div>
			<div class="card-body">
				<table class="datatable table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<!-- user_id firstname   mobile  email   password    user_role   picture district    block   village school_type school_level    school_name sex age class   school_status   father_name father_occup    mother_name mother_occup    socail_status   center_id   remarks created_by  create_date update_date status -->
							<th><?php echo display('serial') ?></th>
							<th><?php echo display('first_name') ?></th>
							<th><?php echo display('mobile') ?></th>
							<th><?php echo display('email') ?></th>
							<th><?php echo display('district') ?></th>
							<th><?php echo display('block') ?></th>
							<th><?php echo display('village') ?></th>
							<th><?php echo display('designation') ?></th>
							<th style="width:80px !important;"><?php echo display('action') ?></th>

						</tr>
					</thead>
					<tbody>
						<?php if (!empty($users)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($users as $user) { ?>
								<tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
									<td><?php echo $sl; ?></td>

									<td><?php echo $user->firstname; ?></td>
									<td>
										<div class="contact">
											<div class="line"></div><a href="tel:+91<?php echo $user->mobile; ?>"><?php echo $user->mobile; ?></a>
										</div>
									</td>
									<td><?php echo $user->email; ?></td>
									<td><?php echo $user->district; ?></td>
									<td><?php echo $user->block; ?></td>
									<td><?php echo $user->village; ?></td>
									<td><?php echo $user_role_list[$user->user_role]; ?></td>
									<td style="width:90px !important;">
										<a href="<?php echo base_url("organisation/cuser/viewUserProfile/$user->user_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
										<a href="<?php echo base_url("organisation/cuser/editUser/$user->user_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
										<a href="<?php echo base_url("organisation/cuser/deleteUser/$user->user_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a>
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

<!-- jQuery 3 -->
<script src="<?php echo base_url('assetslte/'); ?>bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		//district
		/*$('#district').change(function(){
		    alert('Hep');
		});*/
		$("#district").change(function() {
			var center_list1 = $('#center');
			var error = $('#error');

			$.ajax({
				url: '<?= base_url('user/center_by_district/') ?>',
				type: 'post',
				dataType: 'JSON',
				data: {
					'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
					district: $(this).val()
				},
				success: function(data) {
					if (data.status == true) {
						center_list1.html(data.center);
						error.html('');
					} else {
						center_list1.html('<option value="">Select Center</option>');
						//error.html(data.center);
					}
				},
				error: function() {
					alert('failed');
				}
			});
		});

	});
</script>
