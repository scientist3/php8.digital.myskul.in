<div class="row">
  <div class="col-sm-12">
      <div class="callout callout-info">
        <div class="col-sm-4 float-right">
          <div class="form-group float-right">
            <?php echo form_dropdown('active_center_id', $allocated_centers, $this->session->userdata('active_center_id'), 'class="form-control select2bs4" id="active_center_id"'); ?>
          </div>
        </div>
        <h4>
				  <?php echo $this->session->flashdata('active_center'); ?>
        </h4>
      </div>
  </div>
</div>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-blue">
			<div class="inner">
				<h3>
					<?php echo !empty($details->total_students) ? $details->total_students : '0'; ?>
				</h3>

				<p>Total
					<?php echo display("student"); ?>
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('animator/cstudent/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>
					<?php echo !empty($details->new_messages) ? $details->new_messages : '0'; ?>
				</h3>

				<p>New Messages</p>
			</div>
			<div class="icon">
				<i class="ion ion-chatboxes"></i>
			</div>
			<a href="<?php echo base_url('animator/message'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>
					<?php echo !empty($details->total_allocate_centers) ? $details->total_allocate_centers : '0'; ?>
				</h3>

				<p>Center Allocated</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('animator/user/members'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
<!-- ./OVERALL JK -->

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2/js/select2.full.min.js"></script>

<script>
	$(function() {
		// Initialize Select2 dropdown
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})

		$('#active_center_id').on('change', function () {
			var selectedValue = $(this).val();

			// Send the selected value to the server using AJAX
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url("animator/cdashboard/updateActiveCenterId"); ?>', // Update with the actual URL
				data: { active_center_id: selectedValue },
				success: function (response) {
					// Handle the success response if needed
					// For example, you can display a message or update UI elements
					window.location.reload();
				},
				error: function (xhr, status, error) {
					// Handle the error if needed
				}
			});
		});
	})
</script>