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
	<div class="col-sm-12">
		<?php echo form_open_multipart('organisation/cuser/addUser', 'class="form-inner" id="user_form"') ?>
		<?php echo form_hidden('user_id', $student->user_id); ?>
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fa fa-plus"></i> <?php echo $PageTitle; ?>
				</h3>
				<div class="card-tools">
					<a class="btn btn-success" href="<?php echo base_url("organisation/cuser/index") ?>">
						<i class="fa fa-list"></i> <?php echo display('list_user') ?>
					</a>
					<a class="btn btn-primary" href="<?php echo base_url("organisation/cstudent/processStudentForm") ?>">
						<i class="fa fa-plus"></i> <?php echo display('add_student') ?>
					</a>
					<a class="btn btn-primary" href="<?php echo base_url("organisation/cstudent/index") ?>">
						<i class="fa fa-list"></i> <?php echo display('list_student') ?>
					</a>
				</div>
			</div>
			<!-- ... -->
			<div class="card-body card-form">
				<div class="row">
					<div class="col-sm-12 col-md-8">
						<div class="row">
							<!-- Designation -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="user_role"><?php echo display('designation') ?> <i class="text-danger">*</i></label>
									<?php echo form_dropdown('user_role', $designation_list, $student->user_role, 'class="form-control" id="user_role" '); ?>
									<span class="text-danger"><?php echo form_error('user_role'); ?></span>
								</div>
							</div>

							<!-- Cluster -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="cluster_idd"><?php echo display('cluster_name') ?> <i class="text-danger">*</i></label>
									<?php echo form_dropdown('cluster_idd', $cluster_list, $student->cluster_idd, 'class="form-control" id="cluster_idd" '); ?>
									<span class="text-danger"><?php echo form_error('cluster_idd'); ?></span>
								</div>
							</div>

							<!-- district -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="district"><?php echo display('district') ?> <i class="text-danger">*</i></label>
									<?php echo form_dropdown('district', $district_list, $student->district, 'class="form-control" id="district" '); ?>
									<span class="text-danger"><?php echo form_error('district'); ?></span>
								</div>
							</div>

							<!-- FirstName -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="firstname"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
									<input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $student->firstname ?>">
									<span class="text-danger"><?php echo form_error('firstname'); ?></span>
								</div>
							</div>

							<!-- Mobile -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="mobile"><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
									<input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile" value="<?php echo $student->mobile ?>">
									<span class="text-danger"><?php echo form_error('mobile'); ?></span>
								</div>
							</div>

							<!-- email -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="email"><?php echo display('email') ?> <i class="text-danger">*</i></label>
									<input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email') ?>" value="<?php echo $student->email ?>">
									<span class="text-danger"><?php echo form_error('email'); ?></span>
								</div>
							</div>

							<!-- block -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="block"><?php echo display('block') ?> <i class="text-danger">*</i></label>
									<input name="block" class="form-control" type="text" placeholder="<?php echo display('block') ?>" id="block" value="<?php echo $student->block ?>">
									<span class="text-danger"><?php echo form_error('block'); ?></span>
								</div>
							</div>

							<!-- villagea -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="village"><?php echo display('village') ?> <i class="text-danger">*</i></label>
									<input name="village" class="form-control" type="text" placeholder="<?php echo display('village') ?>" id="village" value="<?php echo $student->village ?>">
									<span class="text-danger"><?php echo form_error('village'); ?></span>
								</div>
							</div>

							<!-- age -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="age"><?php echo display('age') ?> <i class="text-danger">*</i></label>
									<input name="age" class="form-control" type="text" placeholder="<?php echo display('age') ?>" id="age" value="<?php echo $student->age ?>">
									<span class="text-danger"><?php echo form_error('age'); ?></span>
								</div>
							</div>

							<!-- Sex -->
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label for="mobile"><?php echo display('gender') ?> <i class="text-danger">*</i></label>
									<div class="btn-group btn-group-toggle form-control" data-toggle="buttons" style="border: none;padding: 0;">
										<label class="btn btn-secondary active">
											<input id="male" type="radio" name="sex" value="Male" <?php echo  set_radio('sex', 'Male', true); ?>><?php echo display('male') ?>
										</label>
										<label class="btn btn-secondary">
											<input id="female" type="radio" name="sex" value="Female" <?php echo  set_radio('sex', 'Female'); ?>><?php echo display('female') ?>
										</label>

									</div>
								</div>
							</div>

							<!-- Status -->
							<div class="col-sm-6 col-md-4">
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

							<!-- Picture -->
							<div class="col-sm-6 col-md-4">
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
			</div>
			<div class="card-footer">
				<button tyep="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?php echo display('save') ?></button>
			</div>
		</div>
		<?php echo form_close() ?>
	</div>
</div>
<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(function() {
		var browseFile = $('#picture');
		var form = $('#user_form');
		var progress = $("#upload-progress");
		var hiddenFile = $("#old_picture");
		var output = $("#output");
		var preview = $('#picture-preview');

		browseFile.on('change', function(e) {
			e.preventDefault();
			var uploadData = new FormData();
			uploadData.append('picture', browseFile[0].files[0]);
			uploadData.append('is_user_form', 1);
			uploadFile(uploadData);
		});

		function uploadFile(uploadData) {
			$.ajax({
				url: '<?php echo base_url('organisation/cuser/handlePictureUpload') ?>',
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

		function showMessage(message, type) {
			output.removeClass('d-none')
				.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + message)
				.removeClass('alert-info')
				.removeClass('alert-danger')
				.addClass('alert-' + type)
				.removeClass('hide');
		}
	});
</script>
