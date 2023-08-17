<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-fuchsia" style="color: white!important;">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_clusters) ? $org_details->total_clusters : '0'; ?>
				</h3>

				<p>Total Clusters</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/cluster'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-red" style="color: white!important;">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_centers) ? $org_details->total_centers : '0'; ?>
				</h3>

				<p>Total
					<?php echo display("center"); ?>
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/center'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_animators) ? $org_details->total_animators : '0'; ?>
				</h3>

				<p>Total Animators</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/user/members'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-blue">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_students) ? $org_details->total_students : '0'; ?>
				</h3>

				<p>Total
					<?php echo display("student"); ?>
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/user/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<!-- ./col -->
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-orange">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_logedin_today) ? $org_details->total_logedin_today : '0'; ?>
				</h3>

				<p>Attendence Report of all for today</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-maroon">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_cor_logedin) ? $org_details->total_cor_logedin : '0'; ?>
				</h3>

				<p>Total Coodinators Loggedin</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-teal">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_ani_logedin) ? $org_details->total_ani_logedin : '0'; ?>
				</h3>

				<p>Total Animators Loggedin</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-lime">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_std_logedin) ? $org_details->total_std_logedin : '0'; ?>
				</h3>

				<p>Total
					<?php echo display("student"); ?> Loggedin
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-olive" style="background-color: #52b8f4 !important;">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_absentee_today) ? $org_details->total_absentee_today : '0'; ?>
				</h3>

				<p>Absentee Report of all for today</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-maroon" style="background-color: #ff2172 !important;">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_cor_absentee) ? $org_details->total_cor_absentee : '0'; ?>
				</h3>

				<p>Total Coodinators Absent today</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-teal" style="background-color: #45e7e7  !important;">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_ani_absentee) ? $org_details->total_ani_absentee : '0'; ?>
				</h3>

				<p>Total Animators Absent today</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-navy" style="background-color: #002b57 !important;">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->total_std_absentee) ? $org_details->total_std_absentee : '0'; ?>
				</h3>

				<p>Total
					<?php echo display("student"); ?> Absent
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-android-contacts"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/userlog/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>
					<?php echo !empty($org_details->new_messages) ? $org_details->new_messages : '0'; ?>
				</h3>

				<p>New Messages</p>
			</div>
			<div class="icon">
				<i class="ion ion-chatboxes"></i>
			</div>
			<a href="<?php echo base_url('dashboard_org/message'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

</div>
<!-- ./OVERALL JK -->
