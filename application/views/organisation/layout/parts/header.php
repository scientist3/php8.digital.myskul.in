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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?= display('dashboard') ?> -
		<?php echo (!empty($title) ? $title : null) ?>
	</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- daterange picker -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/daterangepicker/daterangepicker.css"> -->
	<!-- iCheck for checkboxes and radio inputs -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
	<!-- Bootstrap Color Picker -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"> -->
	<!-- Tempusdominus Bootstrap 4 -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
	<!-- Select2 -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2/css/select2.min.css">
	<link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
	<!-- Bootstrap4 Duallistbox -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css"> -->
	<!-- BS Stepper -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/bs-stepper/css/bs-stepper.min.css"> -->
	<!-- dropzonejs -->
	<!-- <link rel="stylesheet"
		href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>plugins/dropzone/min/dropzone.min.css"> -->
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
