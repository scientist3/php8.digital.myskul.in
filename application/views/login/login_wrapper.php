<?php
defined('BASEPATH') or exit('No direct script access allowed');
//get site_align setting
$settings = $this->db->select("*,site_align")
	->get('setting')
	->row();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<title>
		<?= display('login') ?> -
		<?php echo (!empty($title) ? $title : null) ?>
	</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/css/adminlte.min.css">

	<!-- Select2 -->
	<link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2/css/select2.min.css">
	<link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>

<body class="hold-transition login-page" style="background-color: #232426;">
	<!-- /.login-box -->
	<div class="login-box">
		<div class="login-logo">
			<a href="<?php echo base_url(); ?>"><b>REP</b>V2</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Sign in to start your session</p>
				<!-- alert message -->
				<?php if ($this->session->flashdata('message') != null) { ?>
					<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('message'); ?>
					</div>
				<?php } ?>

				<?php if ($this->session->flashdata('exception') != null) { ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('exception'); ?>
					</div>
				<?php } ?>

				<?php if (validation_errors()) { ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo validation_errors(); ?>
					</div>
				<?php } ?>
				<!-- alert message -->
				<?php echo form_open('login', 'id="loginForm" novalidate'); ?>
				<div class="input-group mb-3">
					<input name="email" type="email" class="form-control" placeholder="Email">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input name="password" type="password" class="form-control" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<?php echo form_dropdown('user_role', $user_role_list, 1 /*$user->user_role*/, 'class="form-control select2bs4" id="user_role" '); ?>
				</div>
				<div class="row justify-content-end">
					<!-- <div class="col-8">
						<div class="icheck-primary">
							<input type="checkbox" id="remember">
							<label for="remember">
								Remember Me
							</label>
						</div>
					</div> -->
					<!-- /.col -->
					<div class="col-6">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
				<?php echo form_close(); ?>

			</div>
			<!-- /.login-card-body -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script
		src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/js/adminlte.min.js"></script>
	<!-- Select2 -->
	<script
		src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2/js/select2.full.min.js"></script>

	<script>
		$(function () {
			// Initialize Select2 dropdown
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>
</body>

</html>