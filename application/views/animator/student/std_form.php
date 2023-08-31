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
		<?php echo form_open_multipart('animator/cstudent/processStudentForm', 'class="form-inner" id=student_form') ?>
		<?php echo form_hidden('user_id', $student->user_id); ?>
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title"></h3>
				<div class="card-tools">
					<a class="btn btn-primary" href="<?php echo base_url("animator/cstudent") ?>"> <i class="fa fa-list"></i> <?php echo display('list_student') ?> </a>
        </div>
			</div>

			<div class="card-body">
				<div id="output" class="d-none alert"></div>
				<div class="row">
					<!-- Cluster Dropdown -->
					<div class="col-sm-6 col-md-4">
						<div class="form-group">
							<label for="cluster_id"><?php echo display('cluster') ?> <i class="text-danger">*</i></label>
							<?php echo form_dropdown('cluster_id', $cluster_list, $student->cluster_idd, 'class="select2bs4 form-control" id="cluster_id" disabled'); ?>
							<span class="cluster_error"></span>
						</div>
					</div>

					<!-- Center Dropdown -->
					<?php if ($student->center_id) { ?>
						<div class="col-sm-6 col-md-4">
							<div class="form-group">
								<label for="center_id"><?php echo display('center_name') ?> <i class="text-danger">*</i></label>
								<?php echo form_dropdown('center_id', $center_list, $student->center_id, 'class="form-control" id="center_id"'); ?>
                <input type="hidden" name="hidden_center_id" id="hidden_center_id" value="<?php echo $student->center_id; ?>">
								<span class="center_error"></span>
							</div>
						</div>
					<?php } else { ?>
						<div class="col-sm-6 col-md-4">
							<div class="form-group">
								<label for="center_id"><?php echo display('center_name') ?> <i class="text-danger">*</i></label>
								<?php echo form_dropdown('center_id',$center_list, '', 'class="form-control" id="center_id" '); ?>
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
									<input id="male" type="radio" name="sex" value="Male" <?php echo  ($student->sex == 'Male')?'checked':''; ?>>
									<?php echo display('male') ?>
								</label>
								<label class="btn btn-secondary">
									<input id="female" type="radio" name="sex" value="Female" <?php echo ($student->sex == 'Female')?'checked':'';?>><?php echo display('female') ?>
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
											<input type="radio" name="age" value="6-11" <?php echo  ($student->age == '6-11')?'checked':''; ?>>
											6-11 Years
										</label>
										<label class="btn btn-secondary">
											<input type="radio" name="age" value="12-18" <?php echo ($student->age == '12-18')?'checked':''; ?>>
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
											<input type="radio" name="status" value="1" <?php echo  ($student->status == '1')?'checked':''; ?>><?php echo display('active') ?>
										</label>
										<label class="btn btn-secondary">
											<input type="radio" name="status" value="0" <?php echo  ($student->status == '0')?'checked':''; ?>><?php echo display('inactive') ?>
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

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/student_form.js'); ?>"></script>

<script type="text/javascript">
	$(document).ready(function () {
		StudentFormModule.uploadFileUrl = "<?php echo base_url('animator/cstudent/handlePictureUpload') ?>";
		StudentFormModule.centerUrl = "<?= base_url('animator/cstudent/center_by_cluster/') ?>" ;
		StudentFormModule.init();
	});
</script>
