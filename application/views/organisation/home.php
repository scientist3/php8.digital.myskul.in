<div id="accordion">
	<div class="card card-primary">
		<div class="card-header">
			<h4 class="card-title w-100">
				<a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
					Basic Dashboard
				</a>
			</h4>
		</div>
		<div id="collapseOne" class="collapse show" data-parent="#accordion">
			<div class="card-body">
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
							<a href="<?php echo base_url('organisation/ccluster'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/ccenter'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cuser/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cuser/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/cattendance/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="<?php echo base_url('organisation/message'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="card card-primary">
		<div class="card-header">
			<h4 class="card-title w-100">
				<a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
					Advance Dashboard
				</a>
			</h4>
		</div>
		<div id="collapseTwo" class="collapse" data-parent="#accordion">
			<div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-primary">
                            <div class="info-box-content">
                                <span class="info-box-text">Session In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->session->in_approval;?></h3>
                                <span class="info-box-text">Session Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->session->approved;?></h3>
                                <a class="small-box-footer bg-primary" href="<?php echo base_url('organisation/cactivities'); ?>" >More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-success">
                           <div class="info-box-content">
                                <span class="info-box-text">CNCP Enrolled In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->cncp_enrolled->in_approval;?></h3>
                                <span class="info-box-text">CNCP Enrolled Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->cncp_enrolled->approved;?></h3>
                                <a class="small-box-footer bg-success" href="<?php echo base_url('organisation/cactivities'); ?>">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-warning">
                            <div class="info-box-content">
                                <span class="info-box-text">CNCP Supported In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->cncp_supported->in_approval;?></h3>
                                <span class="info-box-text">CNCP Supported Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->cncp_supported->approved;?></h3>
                                <a class="small-box-footer bg-warning" href="<?php echo base_url('organisation/cactivities'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-black">
                           <div class="info-box-content">
                                <span class="info-box-text">Psycho Educated In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->psycho_educated->in_approval;?></h3>
                                <span class="info-box-text">Psycho Educated Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->psycho_educated->approved;?></h3>
                                <a class="small-box-footer bg-black" href="<?php echo base_url('organisation/cactivities'); ?>">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-info">
                            <div class="info-box-content">
                                <span class="info-box-text">Primary Counseling In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->primary_counseling->in_approval;?></h3>
                                <span class="info-box-text">Primary Counseling Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->primary_counseling->approved;?></h3>
                                <a href="#" class="small-box-footer bg-info" href="<?php echo base_url('organisation/cactivities'); ?>">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-success">
                            <div class="info-box-content">
                                <span class="info-box-text">Secondary Counseling In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->secondary_counseling->in_approval;?></h3>
                                <span class="info-box-text">Secondary Counseling Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->secondary_counseling->approved;?></h3>
                                <a class="small-box-footer bg-success" href="<?php echo base_url('organisation/cactivities'); ?>">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-warning">
                            <div class="info-box-content">
                                <span class="info-box-text">Psycho Social Well Being In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->psycho_social_well_being->in_approval;?></h3>
                                <span class="info-box-text">Psycho Social Well Being Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->psycho_social_well_being->approved;?></h3>
                                <a class="small-box-footer bg-warning" href="<?php echo base_url('organisation/cactivities'); ?>">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-black">
                            <div class="info-box-content">
                                <span class="info-box-text">Care Plans In Approval</span>
                                <h3 class="info-box-number"><?php echo $activities->care_plans->in_approval;?></h3>
                                <span class="info-box-text">Care Plans Approved</span>
                                <h3 class="info-box-number"><?php echo $activities->care_plans->approved;?></h3>
                                <a class="small-box-footer bg-black" href="<?php echo base_url('organisation/cactivities'); ?>">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>