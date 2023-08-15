<div class="row">
	<div class="col-md-3">

		<!-- Profile Image -->
		<div class="card card-primary card-outline">
			<div class="card-body box-profile">
				<div class="text-center">
					<img class="profile-user-img img-fluid img-circle" src="<?php echo (isset($student->picture) and !empty($student->picture)) ? base_url($student->picture) : base_url("assets/images/no_image.png")  ?>" alt="User profile picture">
				</div>

				<h3 class="profile-username text-center"><?php echo ucfirst($student->firstname); ?></h3>

				<p class="text-muted text-center">Student</p>

				<ul class="list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>Admission Number</b> <a class="float-right"><?php echo $student->user_id; ?></a>
					</li>
					<li class="list-group-item">
						<b>Roll Number</b> <a class="float-right"><?php echo $student->user_id; ?></a>
					</li>
					<li class="list-group-item">
						<b><?php echo display('center_name'); ?></b> <a class="float-right "><?php echo $student->center_name; ?></a>
					</li>
					<li class="list-group-item">
						<b>Age Group</b> <a class="float-right"><?php echo $student->age; ?> yrs</a>
					</li>
					<li class="list-group-item">
						<b>Gender</b> <a class="float-right"><?php echo ucfirst($student->sex); ?></a>
					</li>
				</ul>

				<!--                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

		<!-- About Me Box -->
		<div class="card card-primary d-none">
			<div class="card-header">
				<h3 class="card-title">About Me</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<strong><i class="fas fa-book mr-1"></i> Education</strong>

				<p class="text-muted">
					B.S. in Computer Science from the University of Tennessee at Knoxville
				</p>

				<hr>

				<strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

				<p class="text-muted">Malibu, California</p>

				<hr>

				<strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

				<p class="text-muted">
					<span class="tag tag-danger">UI Design</span>
					<span class="tag tag-success">Coding</span>
					<span class="tag tag-info">Javascript</span>
					<span class="tag tag-warning">PHP</span>
					<span class="tag tag-primary">Node.js</span>
				</p>

				<hr>

				<strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

				<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.col -->
	<div class="col-md-9">
		<div class="card card-outline card-primary">
			<div class="card-header p-2">
				<h3 class="card-title">
					<i class="fa fa-user"></i> Student Profile
				</h3>
			</div><!-- /.card-header -->
			<div class="card-body">
				<div class="tab-content">

					<div class="active tab-pane" id="profile">
						<div class="table-responsive around10 pt0">
							<table class="table table-hover table-striped">
								<tbody>
									<tr>
                                            <td class="col-md-4">Admission Date</td>
										<td class="col-md-5" colspan="2"><?php echo !empty($student->create_date)?date('d-M-Y', strtotime($student->create_date)):null; ?></td>
									</tr>
									<tr>
										<td>Mobile Number</td>
										<td colspan="2"><?php echo $student->mobile; ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td colspan="2"><?php echo $student->email; ?></td>
									</tr>
                                    <tr>
                                        <td colspan="3"><h3 class="pagetitleh2">Address </h3></td>
                                    </tr>
                                    <tr>
                                        <td>District</td>
                                        <td colspan="2"><?php echo $student->district; ?></td>
                                    </tr>
                                    <tr >
                                        <td colspan="3"><h3 class="pagetitleh2">Parent / Guardian Details </h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4">Father Name</td>
                                        <td class="col-md-5" ><?php echo $student->father_name; ?></td>
                                        <td ><img class="profile-user-img img-responsive img-circle" src="<?php echo (isset($student->fpicture) and !empty($student->fpicture)) ? base_url($student->fpicture) : base_url("assets/images/no_image.png")  ?>"></td>
                                    </tr>

                                    <tr>
                                        <td >Mother Name</td>
                                        <td ><?php echo $student->mother_name; ?></td>
                                        <td ><img class="profile-user-img img-responsive img-circle" src="<?php echo (isset($student->mpicture) and !empty($student->mpicture)) ? base_url($student->mpicture) : base_url("assets/images/no_image.png")  ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><h3 class="pagetitleh2">Miscellaneous Details </h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4">Level of School</td>
                                        <td class="col-md-5" colspan="2"><?php echo $student->school_level; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4">Others</td>
                                        <td class="col-md-5" colspan="2"><?php echo $student->school_status; ?></td>
                                    </tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div><!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.col -->
</div>

<div class="row">

	<div class="col-md-9">
		<div class="nav-tabs-custom">

			<div class="tab-content">

				<div class="tab-pane" id="fee">
					<div class="alert alert-danger">No Record Found</div>
				</div>
				<div class="tab-pane" id="timelineh">
					<div class="timeline-header no-border">
						<div id="timeline_list">
							<div class="alert alert-info">No Record Found</div>
						</div>
						<!-- <h2 class="page-header"> </h2> -->
					</div>
				</div>
				<div class="tab-pane" id="documents">
					<div class="timeline-header no-border">
						<button type="button" data-student-session-id="24" class="btn btn-xs btn-primary float-right myTransportFeeBtn mb10"> <i class="fa fa-upload"></i> Upload Documents</button>

						<div class="table-responsive" style="clear: both;">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Title</th>
										<th>Name</th>
										<th class="mailbox-date text-right">Action</th>
									</tr>
								</thead>

								<tbody>

								</tbody>
								<tfoot>
									<tr>
										<td colspan="3" class="text-danger text-center">No Record Found</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>

				</div>
				<div class="tab-pane" id="exam">
					<div class="tshadow mb25">
						<div class="alert alert-danger">
							No Record Found </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- </section> 
</div> -->
