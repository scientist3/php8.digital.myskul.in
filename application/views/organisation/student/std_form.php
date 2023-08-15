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
	<div class="col-sm-12">
		<?php echo form_open_multipart('organisation/cstudent/processStudentForm', 'class="form-inner" id=student_form') ?>
		<?php echo form_hidden('user_id', $student->user_id); ?>
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title"></h3>
				<div class="card-tools">
					<a class="btn btn-primary" href="<?php echo base_url("organisation/cstudent") ?>"> <i class="fa fa-list"></i> <?php echo display('list_student') ?> </a>
					<a class="btn btn-success" href="<?php echo base_url("organisation/cuser/addUser") ?>"> <i class="fa fa-plus"></i> <?php echo display('add_member') ?> </a>
					<a class="btn btn-success" href="<?php echo base_url("organisation/cuser/index") ?>"> <i class="fa fa-list"></i> <?php echo display('list_user') ?> </a>
				</div>
			</div>

			<div class="card-body">
				<div id="output" class="d-none alert"></div>
				<div class="row">
					<!-- Cluster Dropdown -->
					<div class="col-sm-6 col-md-4">
						<div class="form-group">
							<label for="cluster_idd"><?php echo display('cluster') ?> <i class="text-danger">*</i></label>
							<?php echo form_dropdown('cluster_idd', $cluster_list, $student->cluster_idd, 'class="form-control" id="cluster_idd" '); ?>
							<span class="cluster_error"></span>
						</div>
					</div>

					<!-- Center Dropdown -->
					<?php if ($student->center_id) { ?>
						<div class="col-sm-6 col-md-4">
							<div class="form-group">
								<label for="cluster_idd"><?php echo display('center_name') ?> <i class="text-danger">*</i></label>
								<?php echo form_dropdown('center_id', $center_list, $student->center_id, 'class="form-control" id="center_id" '); ?>
								<span class="center_error"></span>
							</div>
						</div>
					<?php } else { ?>
						<div class="col-sm-6 col-md-4">
							<div class="form-group">
								<label for="cluster_idd"><?php echo display('center_name') ?> <i class="text-danger">*</i></label>
								<?php echo form_dropdown('center_id', ['' => display('select_center')], '', 'class="form-control" id="center_id" '); ?>
								<span class="center_error"></span>
							</div>
						</div>
					<?php } ?>

					<!-- District Dropdown -->
					<div class="col-sm-6 col-md-4">
						<div class="form-group">
							<label for="district"><?php echo display('district') ?> <i class="text-danger">*</i></label>
							<?php echo form_dropdown('district', $district_list, $student->district, 'class="form-control" id="district" '); ?>
							<span class="district_error"></span>
						</div>
					</div>

					<!-- First Name -->
					<div class="col-sm-6 col-md-4">
						<div class="form-group">
							<label for="firstname"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
							<input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $student->firstname ?>">
						</div>
					</div>

					<!-- Mobile -->
					<div class="col-sm-6 col-md-4">
						<div class="form-group">
							<label for="mobile"><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
							<input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile" value="<?php echo $student->mobile ?>">
						</div>
					</div>

					<!-- Sex -->
					<div class="col-sm-6 col-md-4">
						<div class="form-group">
							<label for="mobile"><?php echo display('gender') ?> <i class="text-danger">*</i></label>
							<div class="btn-group btn-group-toggle form-control" data-toggle="buttons" style="border: none;padding: 0;">
								<label class="btn btn-secondary active">
									<input id="male" type="radio" name="sex" value="Male" <?php echo  set_radio('sex', 'Male', true); ?>>
									<?php echo display('male') ?>
								</label>
								<label class="btn btn-secondary">
									<input id="female" type="radio" name="sex" value="Female" <?php echo  set_radio('sex', 'Female'); ?>><?php echo display('female') ?>
								</label>

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-8">
						<div class="row">
							<!-- Age -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label for="mobile"><?php echo display('age') ?> <i class="text-danger">*</i></label>
									<div class="btn-group btn-group-toggle form-control" data-toggle="buttons" style="border: none;padding: 0;">
										<label class="btn btn-secondary active">
											<input type="radio" name="age" value="6-11" <?php echo  set_radio('age', '6-11', true); ?>>
											6-11 Years
										</label>
										<label class="btn btn-secondary">
											<input type="radio" name="age" value="12-18" <?php echo  set_radio('age', '12-18'); ?>>
											12-18 Years
										</label>

									</div>
								</div>
							</div>

							<!-- Picture -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label for="picture"><?php echo display('picture') ?> <i class="text-danger">*</i></label>
									<div class="custom-file">
										<!-- <input type="file" name="attach_file" id="attach_file" class="custom-file-input">-->
										<input id="picture" type="file" class="custom-file-input" name="picture" value="<?php echo $student->picture ?>">
										<label class="custom-file-label" for="attach_file">Choose file</label>
										<!-- <input type="hidden" name="hidden_attach_file" id="hidden_attach_file" value="--><?php //echo $material->mat_doc_link
																																																					?><!--">-->
										<input type="hidden" id="old_picture" name="old_picture" value="<?php echo $student->picture ?>">
										<p id="upload-progress" class="hide alert"></p>
									</div>
								</div>
							</div>

							<!-- School Level -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group ">
									<label for="school_level"><?php echo display('school_level') ?></label>
									<?php $school_level = array(
										''   => display('select_option'),
										'Primary' => 'Primary',
										'Middle' => 'Middle',
										'High School' => 'High School'

									);
									echo form_dropdown('school_level', $school_level, $student->school_level, 'class="form-control" id="school_level" ');
									?>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label for="father_name"><?php echo display('father_name') ?></label>
									<input name="father_name" class="form-control" type="text" placeholder="<?php echo display('father_name') ?>" id="father_name" value="<?php echo $student->father_name ?>">
								</div>
							</div>

							<!-- Mother Name -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group ">
									<label for="mother_name"><?php echo display('mother_name') ?></label>
									<input name="mother_name" class="form-control" type="text" placeholder="<?php echo display('mother_name') ?>" id="mother_name" value="<?php echo $student->mother_name ?>">
								</div>
							</div>

							<!-- Enrollment Date -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group ">
									<label for="create_date"><?php echo display('enrol_date') ?></label>
									<input name="create_date" class="form-control " type="date" placeholder="<?php echo display('enrol_date') ?>" id="create_date" value="<?php echo $student->create_date ?>">
								</div>
							</div>

							<!-- Other -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group ">
									<label for="school_status"><?php echo display('other') ?></label>
									<?php
									$school_status = array(
										''   => display('select_option'),
										'Orphan' => 'Orphan',
										'Disable' => 'Disable',
										'School Drop Out' => 'School Drop Out'

									);
									echo form_dropdown('school_status', $school_status, $student->school_status, 'class="form-control" id="school_status" ');
									?>
								</div>
							</div>

							<!-- Status -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label for="mobile"><?php echo display('status') ?> <i class="text-danger">*</i></label>
									<div class="btn-group btn-group-toggle form-control" data-toggle="buttons" style="border: none;padding: 0;">
										<label class="btn btn-secondary active">
											<input type="radio" name="status" value="1" <?php echo  set_radio('status', '1', TRUE); ?>><?php echo display('active') ?>
										</label>
										<label class="btn btn-secondary">
											<input type="radio" name="status" value="0" <?php echo  set_radio('status', '0'); ?>><?php echo display('inactive') ?>
										</label>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="row">
							<!-- if employee picture is already uploaded -->
							<div class="col-sm-12 col-md-12" style="display: flex;justify-content: center;">
								<div class="form-group ">
									<label for="picturePreview"></label>
									<img id="picture-preview" src="<?php echo (isset($student->picture) and !empty($student->picture)) ? base_url($student->picture) : base_url("assets/images/no_image.png")  ?>" alt="Picture" class="img-thumbnail" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button tyep="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?php echo display('save') ?></button>
				</div>
			</div>
		</div>
		<?php echo form_close() ?>
	</div>
</div>

</div>

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(function() {
		var browseFile = $('#picture');
		var form = $('#student_form');
		var progress = $("#upload-progress");
		var hiddenFile = $("#old_picture");
		var output = $("#output");
		var preview = $('#picture-preview');

		browseFile.on('change', function(e) {
			e.preventDefault();
			var uploadData = new FormData();
			uploadData.append('picture', browseFile[0].files[0]);
			uploadData.append('is_student_form', 1);
			uploadFile(uploadData);
		});

		$("#cluster_idd").change(function() {
			var clusterId = $(this).val();
			fetchCentersByCluster(clusterId);
		});

		function uploadFile(uploadData) {
			$.ajax({
				url: '<?php echo base_url('organisation/cuser/do_upload') ?>',
				type: form.attr('method'),
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: uploadData,
				beforeSend: function() {
					hiddenFile.val('');
					progress.removeClass('d-none').html('<i class="fa fa-cog fa-spin"></i> Loading..');
				},
				success: function(data) {
					progress.addClass('d-none');
					if (data.status === false) {
						showMessage(data.exception, 'danger');
					} else if (data.status === true) {
						showMessage(data.message, 'info');
						hiddenFile.val(data.filepath);
						preview.attr('src', data.preview); // Corrected line
					}
				},
				error: function() {
					progress.addClass('d-none');
					showMessage('Failed to upload file.', 'danger');
				}
			});
		}

		function fetchCentersByCluster(clusterId) {
			var output = $('.cluster_error');
			var centerList = $('#center_id');

			$.ajax({
				url: '<?= base_url('organisation/cuser/center_by_cluster/') ?>',
				type: 'post',
				dataType: 'json',
				data: {
					'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
					cluster_idd: clusterId
				},
				success: function(data) {
					if (data.status === true) {
						centerList.html(data.message);
						output.html('');
					} else {
						centerList.html('');
						output.html(data.message).addClass('text-danger').removeClass('text-success');
					}
				},
				error: function() {
					alert('Failed to fetch centers.');
				}
			});
		}

		function showMessage(message, type) {
			output.removeClass('d-none')
				.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + message)
				.removeClass('alert-info')
				.removeClass('alert-danger')
				.addClass('alert-' + type)
				.removeClass('hide')

		}
	});
</script>
