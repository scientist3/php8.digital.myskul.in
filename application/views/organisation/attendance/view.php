<div class="row">
	<!--  table area -->
	<div class="col-sm-3">
		<div class="card card-outline card-info">
			<div class="card-header with-border">
				<h3 class="card-title"><i class="fa fa-search"></i> <?php echo display('select_criteria'); ?></h3>
			</div>
			<div class="card-body">
				<?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success"> <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
				<form role="form" action="<?php echo site_url('organisation/cattendance/view/' . $absenteeFilter->userId) ?>" method="post" class="">
					<?php echo form_hidden('user_id', $absenteeFilter->userId); ?>
					<div class="1row">
						<div class="col-sm-41">
							<div class="form-group">
								<label><?php echo display('start_date'); ?></label> <small class="req"> *</small>
								<input name="start_date" class="form-control " type="date" placeholder="<?php echo display('start_date') ?>" id="start_date" value="<?php echo $absenteeFilter->startDate ?>">
								<span class="text-danger"><?php echo form_error('start_date'); ?></span>
							</div>
						</div>

						<div class="col-sm-41">
							<div class="form-group">
								<label><?php echo display('end_date'); ?></label> <small class="req"> *</small>
								<input name="end_date" class="form-control " type="date" placeholder="<?php echo display('end_date') ?>" id="end_date" value="<?php echo $absenteeFilter->endDate ?>">
								<span class="text-danger"><?php echo form_error('end_date'); ?></span>
							</div>
						</div>
						<div class="col-sm-21 float-right">
							<div class="form-group">
								<label>&nbsp;</label>
								<button type="submit" name="search" value="search_filter" class=" form-control btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo display('search'); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="card card-outline card-info">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-list"></i> <?php echo $title; ?></h3>
			</div>
			<div class="card-body">
				<table width="100%" class="datatable table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th><?php echo display('picture') ?></th>
							<th><?php echo display('first_name') ?></th>
							<th><?php echo display('date') ?></th>
							<th><?php echo display('login') ?></th>
							<th><?php echo display('logout') ?></th>
							<th><?php echo display('user_role') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($userLog)) { ?>
							<?php $sl = 1; ?>
							<?php foreach ($userLog as $user) { ?>
								<tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
									<td>
										<img alt="Picture" src="<?php echo (!empty($user->picture) ? base_url($user->picture) : base_url("assets/images/no_image.png")) ?>" class="img-thumbnail img-responsive" height="50px" width="50px">
									</td>

									<td><?php echo $user->firstname; ?></td>
									<td><?php echo date('d-M-Y', strtotime($user->log->date)); ?></td>
									<td><?php echo isset($user->log->login_time) ? date('h:m a', strtotime($user->log->login_time)) : 'N/A'; ?></td>
									<td><?php echo isset($user->log->logout_time) ? date('h:m a', strtotime($user->log->logout_time)) : 'N/A'; ?></td>

									<td><?php echo $user_role_list[$user->user_role]; ?></td>

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
