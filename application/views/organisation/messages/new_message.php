<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<div class="row">
	<!--  form area -->
	<div class="col-sm-12">
		<?php echo form_open_multipart('organisation/message/new_message/', 'class="form-inner" id="message_form"') ?>
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-edit"></i> <?php echo display('new_message'); ?></h3>
				<div class="card-tools">
					<a class="btn btn-primary" href="<?php echo base_url("organisation/message") ?>"> <i class="fa fa-inbox"></i> <?php echo display('inbox') ?> </a>
					<a class="btn btn-info" href="<?php echo base_url("organisation/message/sent") ?>"> <i class="fa fa-share"></i> <?php echo display('sent') ?> </a>
				</div>
			</div>
			<div class="card-body">
				<div id="output" class="d-none alert"></div>

				<div class="row mb-2">
					<div class="col-sm-3"><label for="user_role"><?php echo display('designation') ?> <i class="text-danger">*</i></label></div>
					<div class="col-sm-6"><?php echo form_dropdown('user_role', $designation_list, $user_role, 'class="select2 form-control" id="user_role" style="width: 100%;"'); ?></div>
					<div class="col-sm-3"><span class="user_role_error"></span> <?php echo form_error('user_role'); ?></div>
				</div>

				<div class="row mb-2">
					<div class="col-sm-3"><label for="receiver_id"><?php echo display('receiver_name') ?> <i class="text-danger">*</i></label></div>
					<div class="col-sm-6"><?php echo form_dropdown('receiver_id', $user_list, !empty($this->session->userdata('receiver_id')) ?
																	$this->session->userdata('receiver_id') :
																	$message->receiver_id, 'class="select2 form-control" id="receiver_id" style="width: 100%;"'); ?></div>
					<div class="col-sm-3">
						<?php $error = form_error('receiver_id'); ?>
						<?php if (!empty($error)) : ?>
							<div class="text-xs alert alert-danger alert-dismissible" style="padding: 5px 37px 0px 5px;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $error; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>

				<div class="row">
					<div class="col-sm-3"><label for="message"><?php echo display('message') ?> <i class="text-danger">*</i></label></div>
					<div class="col-sm-6"><textarea name="message" class="form-control tinymce" placeholder="<?php echo display('message') ?>" rows="7"><?php echo $message->message ?></textarea></div>
					<div class="col-sm-3">
						<?php $error = form_error('message'); ?>
						<?php if (!empty($error)) : ?>
							<div class="text-xs alert alert-danger alert-dismissible" style="padding: 5px 37px 0px 5px;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $error; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
			<div class="card-footer">
				<button tyep="submit" class="btn btn-primary float-right"><i class="fa fa-paper-plane"></i> <?php echo display('send') ?></button>
			</div>
		</div>
		<!--
                <div class="form-group row">
                    <label for="subject" class="col-xs-3 col-form-label"><?php echo display('subject') ?> <i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                        <input name="subject"  type="text" class="form-control" id="subject" placeholder="<?php echo display('subject') ?>" value="<?php echo $message->subject ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="attach_file" class="col-xs-3 col-form-label"><?php echo display('attach_file') ?> <i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                        <input type="file" name="attach_file" id="attach_file">

                        <input type="hidden" name="hidden_attach_file" id="hidden_attach_file" value="<?php echo $message->picture ?>">

                        <p id="upload-progress" class="hide alert"></p>
                    </div>
                </div>
          -->

		<?php echo form_close() ?>
	</div>
</div>


<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script type="text/javascript">
	$(function() {
		$('#user_role').select2({
			placeholder: 'Select User Role',
			// Additional options for User Role dropdown
		});
		$('#receiver_id').select2({
			placeholder: 'Select User',
			// Additional options for User Role dropdown
		});

		// Lazy load Users dropdown based on User Role selection
		$('#user_role').on('select2:select', function(event) {
			var output = $('.user_role_error');
			var receiver_id = $('#receiver_id');
			const selectedRoleId = event.params.data.id;
			// Perform an AJAX request to fetch users based on the selected role
			$.ajax({
				url: '<?= base_url('organisation/message/user_by_role/') ?>', // Replace with the actual URL
				//data: { role_id: selectedRoleId },
				type: 'post',
				data: {
					user_role: $('#user_role').val()
				},
				dataType: 'json',
				success: function(data) {
					// $('#users').empty().append('<option></option>'); // Clear and reset the dropdown
					// $.each(data, function(index, user) {
					//     $('#users').append(new Option(user.text, user.id, false, false));
					// });
					if (data.status == true) {
						receiver_id.html(data.message);
						//available_day.html(data.available_days);
						output.html('');
					} else if (data.status == false) {
						receiver_id.html('');
						output.html(data.message).addClass('text-danger').removeClass('text-success');
					} else {
						receiver_id.html('');
						output.html(data.message).addClass('text-danger').removeClass('text-success');
					}
					// Initialize or update the Users dropdown using Select2
					$('#users').select2({
						placeholder: 'Select Users',
						// Additional options for Users dropdown
					});
				}
			});
		});
		//department_id
		$("#user_role1").change(function() {
			var output = $('.user_role_error');
			var receiver_id = $('#receiver_id');

			$.ajax({
				url: '<?= base_url('organisation/message/user_by_role/') ?>',
				type: 'post',
				dataType: 'JSON',
				data: {
					'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
					user_role: $(this).val()
				},
				beforeSend: function() {
					output.html('');
				},
				success: function(data) {
					if (data.status == true) {
						receiver_id.html(data.message);
						//available_day.html(data.available_days);
						output.html('');
					} else if (data.status == false) {
						receiver_id.html('');
						output.html(data.message).addClass('text-danger').removeClass('text-success');
					} else {
						receiver_id.html('');
						output.html(data.message).addClass('text-danger').removeClass('text-success');
					}
				},
				error: function() {
					alert('failed');
				}
			});
		});
	});
</script>