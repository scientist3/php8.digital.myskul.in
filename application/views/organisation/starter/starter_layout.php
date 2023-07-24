<?php $this->load->view('organisation/starter/parts/header'); ?>
<?php $this->load->view('organisation/starter/parts/navbar'); ?>
<?php $this->load->view('organisation/starter/parts/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?php echo $PageTitle; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active"><?php echo $PageTitle; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
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
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo validation_errors(); ?>
				</div>
			<?php } ?>

			<?php echo (!empty($content) ? $content : null) ?>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('organisation/starter/parts/rightsidebar'); ?>
<?php $this->load->view('organisation/starter/parts/footer'); ?>