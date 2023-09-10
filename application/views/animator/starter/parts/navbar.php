<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url() ?>" class="nav-link <?php echo isset($dashboard) ? $dashboard : null ?>">Dashboard</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url('animator/cprofile/index'); ?>" class="nav-link <?php echo isset($profile_active) ? $profile_active : null ?>">Profile</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url("logout") ?>" class="nav-link">Logout</a>
		</li>
		<!-- <li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url("logout") ?>" class="nav-link">Logout</a>
		</li> -->
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
				<i class="fas fa-th-large"></i>
			</a>
		</li>
	</ul>
</nav>
<!-- /.navbar -->

