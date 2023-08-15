<style>
    .fa-li {
        font-size: 15px;
    }
</style>

<div class="row mb-2">
    <div class="col-md-12 text-right">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url("organisation/cuser/index") ?>""><i class="fa fa-list"></i> <?php echo display('list_user') ?></a>
        <a class="btn btn-danger btn-sm " onclick="printContent('PrintMe')"><i class="fa fa-print"></i></a>
    </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
      <div class="card-header text-muted border-bottom-0">
        User Profile
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7">
            <h2 class="lead"><b><?php echo $profile->firstname ?></b></h2>
            <p class="text-muted text-sm"><b>About: </b><?php echo $user_role_list[$profile->user_role] ?> </p>
            <ul class="ml-4 mb-0 fa-ul text-muted ">
              <li class="small mb-2 d-flex align-items-center"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $profile->district ?>, <?php echo $profile->block ?> <?php echo $profile->village ?></li>
              <li class="small mb-2 d-flex align-items-center"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: +91 <?php echo $profile->mobile ?></li>
              <li class="small mb-2 d-flex align-items-center"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Email #: <?php echo $profile->email ?></li>
              <li class="small mb-2 d-flex align-items-center"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> User #: <?php echo $profile->user_id ?></li>
              <li class="small mb-2 d-flex align-items-center"><span class="fa-li"><i class="fas fa-lg fa-user-plus"></i></span> Created On #: <?php echo $profile->create_date ?></li>
            </ul>
          </div>
          <div class="col-5 text-center">
            <img src="<?php echo (!empty($profile->picture) ? base_url($profile->picture) : base_url("assets/images/no_image.png")) ?>" alt="user-avatar" class="img-circle img-fluid">
          </div>
        </div>
      </div>
      <div class="card-footer d-none">
        <div class="text-right">
          <a href="#" class="btn btn-sm bg-teal">
            <i class="fas fa-comments"></i>
          </a>
          <a href="#" class="btn btn-sm btn-primary">
            <i class="fas fa-user"></i> View Profile
          </a>
        </div>
      </div>
    </div>
  </div>
	<div class="col-md-4 d-none">
    <!-- About Me Box -->
		<div class="card card-primary ">
			<div class="card-header">
				<h3 class="card-title"><?php echo display('user_info') ?></h3>
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
</div>