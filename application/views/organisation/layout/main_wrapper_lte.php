<?php
defined('BASEPATH') or exit('No direct script access allowed');
//get site_align setting
$settings = $this->db->select("site_align")
	->get('setting')
	->row();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>
		<?= display('dashboard') ?> -
		<?php echo (!empty($title) ? $title : null) ?>
	</title>

	<!-- Favicon and touch icons -->
	<link rel="shortcut icon" href="<?= base_url($this->session->userdata('favicon')) ?>">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- daterange picker -->
	<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Bootstrap4 Duallistbox -->
	<link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
	<!-- BS Stepper -->
	<link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
	<!-- dropzonejs -->
	<link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/css/adminlte.min.css">
	<!-- ========================================================= -->
	<?php if (!empty($settings->site_align) && $settings->site_align == "RTL") { ?>
		<!-- THEME RTL -->
		<link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css" />
	<?php } ?>

	<!-- semantic css -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assetslte/'); ?>dist/css/semantic.min.css" type="text/css" /> -->
	<!-- Ionicons -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assetslte/'); ?>bower_components/Ionicons/css/ionicons.min.css"> -->
	<!-- Theme style -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assetslte/'); ?>dist/css/AdminLTE.min.css"> -->
	<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assetslte/'); ?>dist/css/skins/_all-skins.min.css"> -->
	<!-- Morris chart -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assetslte/'); ?>bower_components/morris.js/morris.css"> -->
	<!-- jvectormap -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assetslte/'); ?>bower_components/jvectormap/jquery-jvectormap.css"> -->
	<!-- Date Picker -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('assetslte/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
	<!-- Daterange picker -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('assetslte/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
	<!-- bootstrap wysihtml5 - text editor -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('assetslte/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="<?php echo base_url('siteassets/'); ?>css/select2.min.css" type="text/css" /> -->
	<!-- iCheck for checkboxes and radio inputs -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assetslte/'); ?>plugins/iCheck/all.css"> -->
	<!-- DataTables CSS -->
	<!-- <link href="<?= base_url('assetslte/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css" /> -->

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- jQuery 3 -->
	<!-- <script src="<?php echo base_url('assetslte/'); ?>bower_components/jquery/dist/jquery.min.js"></script> -->

</head>

<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<?php $logo = $this->session->userdata('logo'); ?>
			<a href="<?php echo base_url('dashboard_org/dashboard_org/index') ?>" class="logo" style="padding: 0px">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><img src="<?= base_url('siteassets/org_logo_min.png') ?>" alt="Logo"></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><img src="<?= base_url('siteassets/org_logo.png') ?>" alt="Logo"></span>
			</a>

			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->

				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">


						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<?php $picture = $this->session->userdata('picture'); ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo (!empty($picture) ? base_url($picture) : base_url("assets/images/no-img.png")) ?>"
									class="user-image" alt="User Image">
								<span class="hidden-xs">
									<?php echo $this->session->userdata('fullname') ?>
								</span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img
										src="<?php echo (!empty($picture) ? base_url($picture) : base_url("assets/images/no-img.png")) ?>"
										class="img-circle" alt="User Image">

									<p>
										<?php echo $this->session->userdata('fullname') ?> - Admin
										<small>Member since
											<?php echo date('M. Y', strtotime($this->session->userdata('create_date'))); ?>
										</small>
									</p>
								</li>

								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="btn-group btn-group-justified">
										<a href="<?php echo base_url('dashboard_org/dashboard_org/profile'); ?>"
											class="btn btn-default btn-flat">Profile</a>
										<!--<a href="< ?php echo base_url('dashboard/screenlock') ?>" class="btn btn-default btn-flat">Lock</a>-->
										<a href="<?php echo base_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
									</div>

								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo (!empty($picture) ? base_url($picture) : base_url("assets/images/no-img.png")) ?>"
							class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>
							<?php echo $this->session->userdata('fullname') ?>
						</p>
						<a href="#"><i class="fa fa-circle text-success"></i>
							<?php echo $user_role_list[$this->session->userdata('user_role')]; ?>
						</a>
					</div>
				</div>

				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>

					<li
						class="<?php echo (($this->uri->segment(1) == 'dashboard') && (($this->uri->segment(2) == 'index')) ? "active" : null) ?>">
						<!-- Dashboard -->
						<a href="<?php echo base_url('dashboard_org/dashboard_org/index') ?>">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
								<!--<i class="fa fa-angle-left pull-right"></i>-->
							</span>
						</a>

					</li>
					<!--############################## Userlog ##############################-->
					<li class="treeview <?php echo (($this->uri->segment(2) == "userlog") ? "active" : null) ?>">
						<a href="#">
							<i class="fa fa-file-pdf-o"></i> <span>
								<?php echo display('attendance_report') ?>
							</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url("dashboard_org/userlog/index") ?>">
									<i <?php echo (($this->uri->segment(2) == "userlog") && ($this->uri->segment(3) == "index") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('attendance_by_r_c_c') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/userlog/absent") ?>">
									<i <?php echo (($this->uri->segment(2) == "userlog") && (($this->uri->segment(3) == "absent") || ($this->uri->segment(3) == "")) ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('absentee_report') ?>
								</a>
							</li>
						</ul>
					</li>
					<!--############################## Cluster ##############################-->
					<li class="treeview <?php echo (($this->uri->segment(2) == "cluster") ? "active" : null) ?>">
						<a href="#">
							<i class="fa fa-file-pdf-o"></i> <span>
								<?php echo display('cluster') ?>
							</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url("dashboard_org/cluster/create") ?>">
									<i <?php echo (($this->uri->segment(2) == "cluster") && ($this->uri->segment(3) == "create") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('add_cluster') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/cluster") ?>">
									<i <?php echo (($this->uri->segment(2) == "cluster") && ($this->uri->segment(3) == "") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('list_cluster') ?>
								</a>
							</li>

							<li><a href="<?php echo base_url("dashboard_org/cluster/statistics") ?>">
									<i <?php echo (($this->uri->segment(2) == "cluster") && ($this->uri->segment(3) == "statistics") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('statistics') ?>
								</a>
							</li>

						</ul>
					</li>
					<!--############################## Center ##############################-->
					<li class="treeview <?php echo (($this->uri->segment(2) == "center") ? "active" : null) ?>">
						<a href="#">
							<i class="fa fa-wheelchair"></i> <span>
								<?php echo display('center') ?>
							</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="<?php echo base_url("dashboard_org/center/create") ?>">
									<i <?php echo (($this->uri->segment(2) == "center") && ($this->uri->segment(3) == "create") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('add_center') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/center") ?>">
									<i <?php echo (($this->uri->segment(2) == "center") && ($this->uri->segment(3) == "") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('list_center') ?>
								</a>
							</li>

						</ul>
					</li>

					<!--############################## Material ##############################-->
					<li class="treeview <?php echo (($this->uri->segment(2) == "material") ? "active" : null) ?>">
						<a href="#">
							<i class="fa fa-file-pdf-o"></i> <span>
								<?php echo display('material') ?>
							</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url("dashboard_org/material/create") ?>">
									<i <?php echo (($this->uri->segment(2) == "material") && ($this->uri->segment(3) == "create") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('add_material') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/material/index") ?>">
									<i <?php echo (($this->uri->segment(2) == "material") && (($this->uri->segment(3) == "index") || ($this->uri->segment(3) == "")) ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('view_material') ?>
								</a>
							</li>
						</ul>
					</li>
					<!--############################## User ##############################-->
					<li class="treeview <?php echo (($this->uri->segment(2) == "user") ? "active" : null) ?>">
						<a href="#">
							<i class="fa fa-wheelchair"></i> <span>
								<?php echo display('user') ?>
							</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="<?php echo base_url("dashboard_org/user/create_student") ?>">
									<i <?php echo (($this->uri->segment(2) == "user") && ($this->uri->segment(3) == "create_student") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('add_student') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/user/index") ?>">
									<i <?php echo (($this->uri->segment(2) == "user") && ($this->uri->segment(3) == "") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('list_student') ?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url("dashboard_org/user/create_member") ?>">
									<i <?php echo (($this->uri->segment(2) == "user") && ($this->uri->segment(3) == "create_member") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('add_member') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/user/members") ?>">
									<i <?php echo (($this->uri->segment(2) == "user") && ($this->uri->segment(3) == "members") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('list_user') ?>
								</a>
							</li>
						</ul>
					</li>
					<!--############################## Messages ##############################-->
					<li class="treeview <?php echo (($this->uri->segment(2) == "message") ? "active" : null) ?>">
						<a href="#">
							<i class="fa fa-pencil-square-o"></i> <span>
								<?php echo display('message') ?>
							</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url("dashboard_org/message/new_message") ?>">
									<i <?php echo (($this->uri->segment(2) == "message") && ($this->uri->segment(3) == "new_message") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('new_message') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/message/") ?>">
									<i <?php echo (($this->uri->segment(2) == "message") && ($this->uri->segment(3) == "") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('inbox') ?>
								</a>
							</li>
							<li><a href="<?php echo base_url("dashboard_org/message/sent") ?>">
									<i <?php echo (($this->uri->segment(2) == "message") && ($this->uri->segment(3) == "sent") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i>
									<?php echo display('sent') ?>
								</a>
							</li>
						</ul>
					</li>
					<!--############################## Contact Us ##############################-->
					<?php /*
					<li>
						<a href="<?php echo base_url("contactus/index") ?>">
						<i class="fa fa-envelope"></i> <span><?php echo display('feedback_message'); ?></span>
						<span class="pull-right-container">
						<!--
						<small class="label pull-right bg-yellow">12</small>
						<small class="label pull-right bg-red">5</small>
						-->
						<small class="label pull-right bg-green"><?php echo !empty($new_messages)?$new_messages:'';?></small>
						</span>
						</a>
					</li>
					<!--############################## Settings ##############################-->
					<li class="treeview <?php echo (($this->uri->segment(1) == "setting" || ($this->uri->segment(1) == "dashboard_org/dashboard_org" && $this->uri->segment(2) == "profile") || $this->uri->segment(1) == "language") ? "active" : null) ?>" > <!-- Settings -->
						<a href="#">
						<i class="fa fa-gears"></i> <span><?php echo display('settings'); ?></span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
						</a>
						<ul class="treeview-menu"> 
						<li><a href="<?php echo base_url("setting") ?>">
							<i <?php echo (($this->uri->segment(1) == "setting") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i> 
							<?php echo display('app_setting') ?></a>
						</li>
						<li><a href="<?php echo base_url("dashboard_org/dashboard_org/profile") ?>">
							<i <?php echo (($this->uri->segment(1) == "dashboard_org" && $this->uri->segment(2) == "profile") ? 'class="fa fa-circle" style="color: chartreuse;"' : 'class="fa fa-circle-o"') ?>></i> 
							<?php echo display('profile') ?></a>
						</li>
						
						</ul>
					</li> */?>

				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?php echo str_replace('_', ' ', ucfirst($this->uri->segment(1))) ?>
					<small>
						<?php echo (!empty($title) ? $title : null) ?>
					</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">
						<?php echo str_replace('_', ' ', ucfirst($this->uri->segment(1))) ?>
					</li>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content">

				<!-- alert message -->
				<?php if ($this->session->flashdata('message') != null) { ?>
					<div class="alert alert-info alert-dismissable" style="font-size: 1rem;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('message'); ?>
					</div>
				<?php } ?>

				<?php if ($this->session->flashdata('exception') != null) { ?>
					<div class="alert alert-danger alert-dismissable" style="font-size: 1rem;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('exception'); ?>
					</div>
				<?php } ?>

				<?php if (validation_errors()) { ?>
					<div class="alert alert-danger alert-dismissable" style="font-size: 1rem;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo validation_errors(); ?>
					</div>
				<?php } ?>

				<!-- content START -->
				<?php echo (!empty($content) ? $content : null) ?>
				<!-- content END -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 2.4.0
			</div>
			<strong>
				<?= ($this->session->userdata('footer_text') != null ? $this->session->userdata('footer_text') : null) ?>
				<!--<a href="https://www.facebook.com/scientist33">Click</a>.-->
			</strong>
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- All Script-->
	<div>
		<!-- jQuery -->
		<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>

		<!-- jQuery UI 1.11.4 -->
		<script src="<?php echo base_url('assets/plugins/'); ?>jquery-ui/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script> $.widget.bridge('uibutton ', $.ui.button); </script>
		<!-- Bootstrap 4 -->
		<script
			src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- ==================================== -->

		<!-- daterangepicker -->
		<!-- <script src="<?php echo base_url('assetslte/'); ?>bower_components / moment / min / moment.min.js"></script> -->
		<!-- <script
			src="<?php echo base_url('assetslte/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
		<!-- datepicker -->
		<!-- <script
			src="<?php echo base_url('assetslte/'); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
		<!-- Bootstrap WYSIHTML5 -->
		<!-- <script
			src="<?php echo base_url('assetslte/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
		<!-- Slimscroll -->
		<!-- <script
			src="<?php echo base_url('assetslte/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
		<!-- iCheck 1.0.1 -->
		<!-- <script src="<?php echo base_url('assetslte/'); ?>plugins/iCheck/icheck.min.js"></script> -->
		<!-- DataTables JavaScript -->
		<!-- <script src=" <?php echo base_url("assetslte/datatables/js/dataTables.min.js") ?>"></script> -->
		<!-- FastClick -->
		<!-- <script src="<?php echo base_url('assetslte/'); ?>bower_components/fastclick/lib/fastclick.js"></script> -->

		<!-- Select2 -->
		<script
			src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2/js/select2.full.min.js"></script>

		<script>
			$(document).ready(function () {
				// Initialize Select2 dropdown
				$('.select2bs4').select2({
					theme: 'bootstrap4'
				})
			})
		</script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/js/adminlte.min.js"></script>

		<!-- semantic js -->
		<!-- <script src="<?php echo base_url('assetslte/') ?>dist/js/semantic.min.js" type="text/javascript"></script> -->
		<!--  bs-custom-file-input  -->
		<!-- <script src="<?php echo base_url('assetslte/') ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"
			type="text/javascript"></script> -->

		<script>
			// "use strict";
			// $(document).ready(function () {

			// 	bsCustomFileInput.init();
			// 	//datatable
			// 	$('.datatable').DataTable({
			// 		responsive: true,
			// 		dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
			// 		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			// 		buttons: [
			// 			{ extend: 'copy', className: 'btn-sm' },
			// 			{ extend: 'csv', title: 'ExampleFile', className: 'btn-sm' },
			// 			{ extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle' },
			// 			{ extend: 'pdf', title: 'ExampleFile', className: 'btn-sm' },
			// 			{ extend: 'print', className: 'btn-sm' }
			// 		]
			// 	});
			// });
			// //print a div
			// function printContent(el) {
			// 	var restorepage = $('body').html();
			// 	var printcontent = $('#' + el).clone();
			// 	$('body').empty().html(printcontent);
			// 	window.print();
			// 	$('body').html(restorepage);
			// 	location.reload();
			// }
			// $("select.form-control:not(.dont-select-me)").select2({
			// 	placeholder: "Select option",
			// 	allowClear: true
			// });
		</script>
	</div>
	<!--./Script-->
</body>

</html>