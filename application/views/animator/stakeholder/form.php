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
		<?php echo form_open_multipart('animator/cstakeholder/processStakeholderForm', 'class="form-inner" id=student_form') ?>
		<?php echo form_hidden('user_id', $stakeholder->user_id); ?>
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title"></h3>
                <div class="card-tools float-none">
                    <div class="row form-inline">
                        <div class="col-sm-2 mt-1 <?php echo isset($hideStakeholderType) ? $hideStakeholderType : null; ?>">
                            <label for="inputEmail3" class="col-form-label justify-content-start">Stakeholder Type</label>
                        </div>
                        <div class="col-sm-7 mt-1 <?php echo isset($hideStakeholderType) ? $hideStakeholderType : null; ?>">
	                        <?php echo form_dropdown('stakeholder_type_id', $stakeholder_type_list, $stakeholder->stakeholder_type_id, 'class="form-control w-100" id="stakeholder_list" '); ?>
                        </div>

                        <div class="col-sm-3 mt-1 <?php echo isset($hideStakeholderType) ? 'offset-9' : null; ?>">
                            <a class="btn btn-primary btn-block" href="<?php echo base_url('animator/cstakeholder')?>"> <i class="fa fa-list"></i> <?php echo display('list_stakeholders')?></a>
                        </div>
                    </div>

                </div>
			</div>

			<div class="card-body">
				<div id="output" class="d-none alert"></div>
				<div class="row">
					<!-- Common Properties -->
					<!-- First Name -->
					<div class="col-sm-4 col-md-4">
						<div class="form-group">
							<label for="firstname"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
							<input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $stakeholder->firstname ?>">
						</div>
					</div>
					<!-- Age -->
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="age"><?php echo display('age') ?> <i class="text-danger">*</i></label>
                            <input name="age" type="number" class="form-control" id="age" placeholder="<?php echo display('age') ?>" value="<?php echo $stakeholder->age ?>">
                        </div>
                    </div>
					<!-- Village Name -->
					<div class="col-sm-4 col-md-4">
						<div class="form-group">
							<label for="village"><?php echo display('village') ?> <i class="text-danger">*</i></label>
							<input name="village" type="text" class="form-control" id="village" placeholder="<?php echo display('village') ?>" value="<?php echo $stakeholder->village ?>">
						</div>
					</div>

					<!-- Common Properties End-->

					<!-- Father Name -->
					<div class="col-sm-4 col-md-4 d-none voluntaries">
						<div class="form-group">
							<label for="father_name"><?php echo display('father_name') ?></label>
							<input name="father_name" class="form-control" type="text" placeholder="<?php echo display('father_name') ?>" id="father_name" value="<?php echo $stakeholder->father_name ?>">
						</div>
					</div>
					<!-- Sex -->
					<div class="col-sm-4 col-md-4 d-none parent local">
						<div class="form-group">
							<label for="mobile"><?php echo display('gender') ?> <i class="text-danger">*</i></label>
							<div class="btn-group btn-group-toggle form-control" data-toggle="buttons" style="border: none;padding: 0;">
								<label class="btn btn-secondary active">
									<input id="male" type="radio" name="sex" value="Male" <?php echo ($stakeholder->sex == 'Male') ? 'checked' : ''; ?>>
									<?php echo display('male') ?>
								</label>
								<label class="btn btn-secondary">
									<input id="female" type="radio" name="sex" value="Female" <?php echo ($stakeholder->sex == 'Female') ? 'checked' : ''; ?>><?php echo display('female') ?>
								</label>

							</div>
						</div>
					</div>
					<!-- District Dropdown -->
					<div class="col-sm-4 col-md-4 d-none parent local">
						<div class="form-group">
							<label for="district"><?php echo display('district') ?> <i class="text-danger">*</i></label>
							<?php echo form_dropdown('district', $district_list, $stakeholder->district, 'class="form-control" id="district" '); ?>
							<span class="district_error"></span>
						</div>
					</div>

					<!-- Social Partiy Dropdown -->
					<div class="col-sm-4 col-md-4 parent local d-none">
						<div class="form-group">
							<label for="socail_status"><?php echo display('Social Parity') ?> <i class="text-danger">*</i></label>
							<?php echo form_dropdown('socail_status', $social_party_list, $stakeholder->socail_status, 'class="form-control" id="socail_status" '); ?>
							<span class="socail_status_error"></span>
						</div>
					</div>
					<!-- Date Of Joining Dropdown -->
                    <div class="col-sm-4 col-md-4 d-none voluntaries">
                        <div class="form-group">
                            <label for="date_of_joining"><?php echo display('Date Of Joining') ?> <i class="text-danger">*</i></label>
                            <input name="date_of_joining" type="date" class="form-control" id="date_of_joining" placeholder="<?php echo display('date_of_joining') ?>" value="<?php echo $stakeholder->date_of_joining ?>">
                        </div>
                    </div>
					<!-- Designation Dropdown -->
                    <div class="col-sm-4 col-md-4 d-none local">
                        <div class="form-group">
                            <label for="designation"><?php echo display('Designation') ?> <i class="text-danger">*</i></label>
                            <input name="designation" type="text" class="form-control" id="designation" placeholder="<?php echo display('Designation') ?>" value="<?php echo $stakeholder->designation ?>">
                        </div>
                    </div>

					<!-- Group Name Dropdown -->
                    <div class="col-sm-4 col-md-4 d-none local">
                        <div class="form-group">
                            <label for="group_name"><?php echo display('Group Name') ?> <i class="text-danger">*</i></label>
                            <input name="group_name" type="text" class="form-control" id="group_name" placeholder="<?php echo display('Group Name') ?>" value="<?php echo $stakeholder->group_name ?>">
                        </div>
                    </div>
					<!-- class -->
                    <div class="col-sm-4 col-md-4 d-none voluntaries">
                        <div class="form-group">
                            <label for="class"><?php echo display('Class') ?> <i class="text-danger">*</i></label>
                            <input name="class" type="text" class="form-control" id="class" placeholder="<?php echo display('Class') ?>" value="<?php echo $stakeholder->class ?>">
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
<script src="<?php echo base_url('assets/js/stakeholder.js'); ?>"></script>

<script type="text/javascript">
	$(document).ready(function() {
        const stakeholder_type_id = '<?php echo isset($stakeholder->stakeholder_type_id) ? $stakeholder->stakeholder_type_id : 1 ?>'
		StudentFormModule.uploadFileUrl = "<?php echo base_url('animator/stakeholder/handlePictureUpload') ?>";
		StudentFormModule.centerUrl = "<?= base_url('animator/stakeholder/center_by_cluster/') ?>";
		StudentFormModule.init();
		showHideInputs(stakeholder_type_id);
		$('#stakeholder_list').on('change', function() {
			showHideInputs(this.value);
		});
	});

	function showHideInputs(selectedValue) {
		selectedValue = Number.parseInt(selectedValue);
		if (selectedValue === 1) {
			// Show fields for option 1
			$('.local, .voluntaries').addClass('d-none');
            $('.parent').removeClass('d-none');
		} else if (selectedValue === 2) {
			// Show fields for option 2
            $('.parent, .local').addClass('d-none');
            $('.voluntaries').removeClass('d-none');
		} else if (selectedValue === 3) {
			// Show fields for option 3
            $('.parent, .voluntaries').addClass('d-none');
            $('.local').removeClass('d-none');
		}
	}
</script>