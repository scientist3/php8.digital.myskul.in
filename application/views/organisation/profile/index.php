<!-- <?php $picture = $this->session->userdata('picture'); ?> -->
<?php $picture = $user->picture; ?>

<div class="row">
	<!-- Left Side -->
	<div class="col-md-3">
		<!-- Profile Image -->
		<div class="card card-primary card-outline">
			<div class="card-body box-profile">
				<div class="text-center">
					<img class="profile-user-img img-fluid img-circle" src="<?php echo (!empty($picture) ? base_url($picture) : base_url("siteassets/images/no_image.png")) ?>" alt="User profile picture">
				</div>

				<h3 class="profile-username text-center">
					<?php echo $user->firstname ?>
				</h3>

				<p class="text-muted text-center">
					<?php echo $user_role_list[$this->session->userdata('user_role')] ?>
				</p>
				<!-- Not Used -->
				<ul class="list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>Email</b> <a class="float-right">
							<?php echo $user->email ?>
						</a>
					</li>
					<li class="list-group-item">
						<b>Phone No</b> <a class="float-right">
							<?php echo $user->mobile ?>
						</a>
					</li>
				</ul>

				<a href="#" class="btn btn-primary btn-block d-none"><b>Follow</b></a>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- Right Side -->
	<div class="col-md-9">
		<div class="card card-primary card-outline">
			<div class="card-header p-2">
				<ul class="nav nav-pills">
					<li class="nav-item"><a class="nav-link" href="#details" data-toggle="tab">Details</a></li>
					<li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
				</ul>
			</div><!-- /.card-header -->
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane" id="details">
						<!-- Post -->
						<div class="post">
							<div class="user-block">
								<img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
								<span class="username">
									<a href="#">Jonathan Burke Jr.</a>
									<a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
								</span>
								<span class="description">Shared publicly - 7:30 PM today</span>
							</div>
							<!-- /.user-block -->
							<p>
								Lorem ipsum represents a long-held tradition for designers,
								typographers and the like. Some people hate it and argue for
								its demise, but others ignore the hate as they create awesome
								tools to help create filler text for everyone from bacon lovers
								to Charlie Sheen fans.
							</p>

							<p>
								<a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
								<a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
								<span class="float-right">
									<a href="#" class="link-black text-sm">
										<i class="far fa-comments mr-1"></i> Comments (5)
									</a>
								</span>
							</p>

							<input class="form-control form-control-sm" type="text" placeholder="Type a comment">
						</div>
						<!-- /.post -->

						<!-- Post -->
						<div class="post clearfix">
							<div class="user-block">
								<img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
								<span class="username">
									<a href="#">Sarah Ross</a>
									<a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
								</span>
								<span class="description">Sent you a message - 3 days ago</span>
							</div>
							<!-- /.user-block -->
							<p>
								Lorem ipsum represents a long-held tradition for designers,
								typographers and the like. Some people hate it and argue for
								its demise, but others ignore the hate as they create awesome
								tools to help create filler text for everyone from bacon lovers
								to Charlie Sheen fans.
							</p>

							<form class="form-horizontal">
								<div class="input-group input-group-sm mb-0">
									<input class="form-control form-control-sm" placeholder="Response">
									<div class="input-group-append">
										<button type="submit" class="btn btn-danger">Send</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.post -->

						<!-- Post -->
						<div class="post">
							<div class="user-block">
								<img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
								<span class="username">
									<a href="#">Adam Jones</a>
									<a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
								</span>
								<span class="description">Posted 5 photos - 5 days ago</span>
							</div>
							<!-- /.user-block -->
							<div class="row mb-3">
								<div class="col-sm-6">
									<img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
								</div>
								<!-- /.col -->
								<div class="col-sm-6">
									<div class="row">
										<div class="col-sm-6">
											<img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
											<img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
										</div>
										<!-- /.col -->
										<div class="col-sm-6">
											<img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
											<img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->

							<p>
								<a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
								<a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
								<span class="float-right">
									<a href="#" class="link-black text-sm">
										<i class="far fa-comments mr-1"></i> Comments (5)
									</a>
								</span>
							</p>

							<input class="form-control form-control-sm" type="text" placeholder="Type a comment">
						</div>
						<!-- /.post -->
					</div>
					<!-- /.tab-pane -->
					<div class="active tab-pane" id="settings">
						<?php echo form_open_multipart('organisation/cprofile/saveProfile/', 'class="form-horizontal" id="js-profile-form"') ?>
						<?php echo form_hidden('user_id', $user->user_id) ?>
						<!-- First Name -->
						<div class="form-group row">
							<label for="inputName" class="col-sm-2 col-form-label">Name</label>
							<div class="col-sm-10">
								<input name="firstname" type="text" class="form-control" id="firstname" placeholder="Name" value="<?php echo $user->firstname ?>">
							</div>
						</div>
						<!-- Email Id-->
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input name="email" type="email" class="form-control" id="email" placeholder="<?php echo display('email') ?>" value="<?php echo $user->email ?>">
							</div>
						</div>
						<!-- Password -->
						<div class="form-group row">
							<label for="inputName2" class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input name="password" type="password" class="form-control" id="password" placeholder="<?php echo display('password') ?>" value="">
							</div>
						</div>
						<!-- Mobile No -->
						<div class="form-group row">
							<label for="inputExperience" class="col-sm-2 col-form-label">Phone No</label>
							<div class="col-sm-10">
								<input name="mobile" type="text" class="form-control" id="mobile" placeholder="<?php echo display('mobile') ?>" value="<?php echo $user->mobile ?>">
							</div>
						</div>
						<!-- Sex -->
						<div class="form-group row">
							<label for="inputSkills" class="col-sm-2 col-form-label">Gender</label>
							<div class="col-sm-10">
								<div class="form-group">
									<div class="custom-control custom-radio">
										<input id="sex_male" class="custom-control-input" type="radio" name="sex" value="Male" <?php echo set_radio('sex', 'Male', TRUE); ?>>
										<label for="sex_male" class="custom-control-label">
											<?php echo display('male') ?>
										</label>
									</div>
									<div class="custom-control custom-radio">
										<input id="sex_female" class="custom-control-input" type="radio" name="sex" value="Female" <?php echo set_radio('sex', 'Female'); ?>>
										<label for="sex_female" class="custom-control-label">
											<?php echo display('female') ?>
										</label>
									</div>
									<div class="custom-control custom-radio">
										<input id="sex_other" class="custom-control-input" type="radio" name="sex" value="Other" <?php echo set_radio('sex', 'Other'); ?>>
										<label for="sex_other" class="custom-control-label">
											<?php echo display('other') ?>
										</label>
									</div>
								</div>
							</div>
						</div>
						<!-- if employee picture is already uploaded -->
						<?php if (!empty($user->picture)) { ?>
							<div class="form-group row">
								<label for="picturePreview" class="col-sm-2 col-form-label">Picture</label>
								<div class="col-sm-10">
									<img src="<?php echo base_url($user->picture) ?>" alt="Picture" class="img-thumbnail" />
								</div>
							</div>
						<?php } ?>
						<!--  Picture -->
						<div class="form-group row">
							<label for="inputExperience" class="col-sm-2 col-form-label">Choose Picture</label>
							<div class="col-sm-10">
								<div class="custom-file">
									<input class="custom-file-input" type="file" name="picture" id="picture" value="<?php echo $user->picture ?>">
									<label class="custom-file-label" for="picture">Choose file</label>
								</div>
								<input type="hidden" name="old_picture" value="<?php echo $user->picture ?>">
							</div>
						</div>
						<!-- Status -->
						<div class="form-group row">
							<label for="inputSkills" class="col-sm-2 col-form-label">Status</label>
							<div class="col-sm-10">
								<div class="form-group">
									<div class="custom-control custom-radio">
										<input id="status_active" class="custom-control-input" type="radio" name="status" value="1" <?php echo set_radio('status', '1', TRUE); ?>>
										<label for="status_active" class="custom-control-label">
											<?php echo display('active') ?>
										</label>
									</div>
									<div class="custom-control custom-radio">
										<input id="status_inactive" class="custom-control-input" type="radio" name="status" value="0" <?php echo set_radio('status', '0'); ?>>
										<label for="status_inactive" class="custom-control-label">
											<?php echo display('inactive') ?>
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<div class="checkbox">
									<label>
										<input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
									</label>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<button type="submit" class="btn btn-danger">Submit</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
					<!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div><!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>
