<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-red" style="color: white!important;">
			<div class="inner">
				<h3>
					<?php echo !empty($details->total_centers) ? $details->total_centers : '0'; ?>
				</h3>

				<p>Total
					<?php echo display("center"); ?>
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="<?php echo base_url('coordinator/ccenter'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>
					<?php echo !empty($details->total_animators) ? $details->total_animators : '0'; ?>
				</h3>

				<p>Total Animators</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('coordinator/cuser/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
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
			<a href="<?php echo base_url('coordinator/user/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
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
			<a href="<?php echo base_url('coordinator/message'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

</div>
<!-- ./OVERALL JK -->
