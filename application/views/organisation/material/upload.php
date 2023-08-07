<div class="row">
	<!--  form area -->
	<div class="col-sm-12">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-plus"></i> <?php echo display('add_study_matterial'); ?></h3>

				<div class="card-tools">
					<ul class="nav nav-pills ml-auto">
						<li class="nav-item">
							<a class="btn btn-primary" href="<?php echo base_url("organisation/cmaterial") ?>"> <i class="fa fa-list"></i> <?php echo display('view_material') ?> </a>
						</li>
					</ul>
				</div>
			</div>
			<?php //echo "<pre>"; print_r($material); echo "</pre>"; 
			?>
			<?php echo form_open_multipart('organisation/cmaterial/create', 'class="form-inner" id="mailForm"') ?>
			<?php echo form_hidden('mat_id', $material->mat_id); ?>
			<div class="card-body">
				<div id="output" class="d-none alert"></div>

				<div class="row d-none">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Text</label>
							<input type="text" class="form-control" placeholder="Enter ...">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Text Disabled</label>
							<input type="text" class="form-control" placeholder="Enter ..." disabled="">
						</div>
					</div>
				</div>
				<div class="form-group ">
					<label for="mat_title"><?php echo display('title') ?> <i class="text-danger">*</i></label>
					<input name="mat_title" type="text" class="form-control" id="mat_title" placeholder="<?php echo display('title') ?>" value="<?php echo $material->mat_title ?>">
				</div>

				<div class="form-group ">
					<label for="mat_desc"><?php echo display('description') ?> <i class="text-danger">*</i></label>

					<textarea name="mat_desc" class="form-control" placeholder="<?php echo display('description') ?>" maxlength="140" rows="2"><?php echo $material->mat_desc ?></textarea>

				</div>

				<div class="btn-group btn-group-toggle" data-toggle="buttons">
					<label class="btn btn-secondary active">
						<input type="radio" name="mat_type" id="video" value="1" autocomplete="off" <?php echo  set_radio('mat_type', '1', true); ?>> <?php echo display('video_link') ?>
					</label>
					<label class="btn btn-secondary">
						<input type="radio" name="mat_type" id="url" value="2" autocomplete="off" <?php echo  set_radio('mat_type', '2'); ?>> <?php echo display('attach_file') ?>
					</label>

				</div>
				<!-- < ?php echo ($material->mat_type == 1 || (!isset($material->mat_type) && $material->mat_type != 2)) ? '' : 'd-none'; ?> -->
				<div class="form-group" id="video_link">
					<label for="mat_video_link"><?php echo display('video_link') ?> <i class="text-danger">*</i></label>
					<div class="col-xs-9">
						<input name="mat_video_link" type="text" class="form-control" id="mat_video_link" placeholder="<?php echo display('video_link') ?>" value="<?php echo $material->mat_video_link ?>">
					</div>
				</div>
				<!-- < ?php echo ($material->mat_type == 2) ? '' : 'd-none'; ?> -->
				<div class="form-group" id="filetype">
					<label for="attach_file"><?php echo display('attach_file') ?> <i class="text-danger">*</i></label>
					<div class="custom-file">
						<input type="file" name="attach_file" id="attach_file" class="custom-file-input">
						<label class="custom-file-label" for="attach_file">Choose file</label>
						<input type="hidden" name="hidden_attach_file" id="hidden_attach_file" value="<?php echo $material->mat_doc_link ?>">
						<p id="upload-progress" class="hide alert"></p>
					</div>
				</div>
				<div class="form-group ">
					<label for="cluster_idd" class="col-xs-3 col-form-label"><?php echo display('cluster_name') ?> <i class="text-danger">*</i></label>
					<div class="col-xs-9">
						<?php echo form_dropdown('cluster_idd', $cluster_list, $material->cluster_idd, 'class="form-control" id="cluster_idd" ');	?>
						<span class="cluster_error"></span>
					</div>
				</div>

				<div class="form-group ">
					<label for="center_idd" class="col-xs-3 col-form-label"><?php echo display('center_name') ?> <i class="text-danger">*</i></label>
					<div class="col-xs-9">
						<?php echo form_dropdown('center_idd', '', '', 'class="form-control" id="center_idd"') ?>
						<!-- <div id="available_days"></div> -->
					</div>
				</div>

				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
					<label class="custom-control-label" for="customSwitch1">Toggle this custom switch element</label>
				</div>

				<div class="form-group">
					<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
						<input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
						<label class="custom-control-label" for="customSwitch3">Inactive/Active</label>
					</div>
				</div>
				<div class="btn-group btn-group-toggle" data-toggle="buttons">
					<label class="btn btn-secondary active">
						<input type="radio" name="options" id="option_a1" autocomplete="off" checked=""> Active
					</label>
					<label class="btn btn-secondary">
						<input type="radio" name="options" id="option_a2" autocomplete="off"> Radio
					</label>

				</div>
				<div class="form-group ">

					<label class="col-sm-3"><?php echo display('status') ?></label>
					<div class="col-xs-9">
						<div class="form-check">
							<label class="radio-inline">
								<input type="radio" name="mat_status" value="1" <?php echo  set_radio('mat_status', '1', TRUE); ?>><?php echo display('active') ?>
							</label>
							<label class="radio-inline">
								<input type="radio" name="mat_status" value="0" <?php echo  set_radio('mat_status', '0'); ?>><?php echo display('inactive') ?>
							</label>
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
		var browseFile = $('#attach_file');
		var form = $('#mailForm');
		var progress = $("#upload-progress");
		var hiddenFile = $("#hidden_attach_file");
		var output = $("#output");

		browseFile.on('change', function(e) {
			e.preventDefault();
			uploadData = new FormData(form[0]);

			$.ajax({
				url: '<?php echo base_url('organisation/cmaterial/do_upload') ?>',
				type: form.attr('method'),
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: uploadData,
				beforeSend: function() {
					hiddenFile.val('');
					progress.removeClass('hide').html('<i class="fa fa-cog fa-spin"></i> Loading..');
				},
				success: function(data) {
					debugger
					progress.addClass('hide');
					if (data.status == false) {
						output.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.exception).addClass('alert-danger').removeClass('hide').removeClass('alert-info');
					} else if (data.status == true) {
						output.html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.message).addClass('alert-info').removeClass('hide').removeClass('alert-danger');
						hiddenFile.val(data.filepath);
					}
				},
				error: function() {
					progress.addClass('d-none');
					output.addClass('d-none');
					alert('failed!');
				}
			});
		});



		$('#filetype').hide();

		// Check which radio button is initially selected and show/hide accordingly
		if ($('#video').is(':checked')) {
			$('#video_link').show();
		} else if ($('#url').is(':checked')) {
			$('#filetype').show();
		}

		// Toggle show/hide when radio buttons are clicked
		$('#video').click(function() {
			$('#video_link').show();
			$('#filetype').hide();
		});

		$('#url').click(function() {
			$('#video_link').hide();
			$('#filetype').show();
		});

		// $("input[name=mat_type]").trigger('change');
		// $('.datetimepicker').datepicker({
		// 	dateFormat: "dd-mm-yy HH:mm:ss"
		// });
		//department_id
		$("#cluster_idd").change(function() {
			var output = $('.cluster_error');
			var center_list = $('#center_idd');
			//var available_day = $('#available_day');

			$.ajax({
				url: '<?= base_url('organisation/cmaterial/center_by_cluster/') ?>',
				type: 'post',
				dataType: 'JSON',
				data: {
					'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
					cluster_idd: $(this).val()
				},
				success: function(data) {
					if (data.status == true) {
						center_list.html(data.message);
						//available_day.html(data.available_days);
						output.html('');
					} else if (data.status == false) {
						center_list.html('');
						output.html(data.message).addClass('text-danger').removeClass('text-success');
					} else {
						center_list.html('');
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