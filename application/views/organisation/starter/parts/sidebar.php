<?php $picture = $this->session->userdata('picture'); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo base_url(); ?>" class="brand-link">
		<img src="<?php echo base_url('vendor/almasaeed2010/adminlte/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">REP-V2</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?php echo (!empty($picture) ? base_url($picture) : base_url("assets/images/no-img.png")) ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">
					<?php echo $this->session->userdata('fullname') ?>
				</a>
				<a href="#" class="text-xs">
					<i class="fa fa-circle text-success text-sm"></i>
					<?php echo $user_role_list[$this->session->userdata('user_role')]; ?>
				</a>
			</div>
		</div>

		<!-- SidebarSearch Form -->
		<div class="form-inline d-none">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
							with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?php echo base_url('organisation/dashboard/index') ?>" class="nav-link <?php echo $dashboard ?? null; ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
							<!-- <i class="right fas fa-angle-left"></i> -->
						</p>
					</a>
				</li>
				<!-- Add/List/Statistics Cluster -->
				<li class="nav-item <?php echo $cluster_menu ?? null; ?>">
					<a href="#" class="nav-link <?php echo isset($cluster_menu) ? 'active' : null; ?>">
						<i class="nav-icon fas fa-chart-pie"></i>
						<p>
							<?php echo display('cluster'); ?>
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("organisation/ccluster/index") ?>" class="nav-link <?php echo $cluster_add_list_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('add_list_cluster'); ?></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('organisation/ccluster/statistics'); ?>" class="nav-link <?php echo $cluster_statistics_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('cluster_statistics'); ?></p>
							</a>
						</li>
					</ul>
				</li>
				<!-- Attendance Report -->
				<li class="nav-item <?php echo $attendance_menu ?? null; ?>">
					<a href="#" class="nav-link <?php echo isset($attendance_menu) ? 'active' : null; ?>">
						<i class="nav-icon fas fa-tree"></i>
						<p>
							<?php echo display('attendance_report'); ?>
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("organisation/cattendance/index") ?>" class="nav-link <?php echo $attendance_by_rcc ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Attendance By R/C/C</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("organisation/cattendance/absent") ?>" class="nav-link <?php echo $absentees_report ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Absentee</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Forms
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="../forms/general.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>General Elements</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../forms/advanced.html" class="nav-link active">
								<i class="far fa-circle nav-icon"></i>
								<p>Advanced Elements</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../forms/editors.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Editors</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../forms/validation.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Validation</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-table"></i>
						<p>
							Tables
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="../tables/simple.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Simple Tables</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../tables/data.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>DataTables</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../tables/jsgrid.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>jsGrid</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">EXAMPLES</li>
				<li class="nav-item">
					<a href="../calendar.html" class="nav-link">
						<i class="nav-icon far fa-calendar-alt"></i>
						<p>
							Calendar
							<span class="badge badge-info right">2</span>
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="../gallery.html" class="nav-link">
						<i class="nav-icon far fa-image"></i>
						<p>
							Gallery
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="../kanban.html" class="nav-link">
						<i class="nav-icon fas fa-columns"></i>
						<p>
							Kanban Board
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-envelope"></i>
						<p>
							Mailbox
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="../mailbox/mailbox.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Inbox</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../mailbox/compose.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Compose</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../mailbox/read-mail.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Read</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-book"></i>
						<p>
							Pages
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="../examples/invoice.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Invoice</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/profile.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Profile</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/e-commerce.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>E-commerce</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/projects.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Projects</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/project-add.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Project Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/project-edit.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Project Edit</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/project-detail.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Project Detail</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/contacts.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Contacts</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/faq.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>FAQ</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/contact-us.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Contact us</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-plus-square"></i>
						<p>
							Extras
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Login & Register v1
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="../examples/login.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Login v1</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/register.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Register v1</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/forgot-password.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Forgot Password v1</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/recover-password.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Recover Password v1</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Login & Register v2
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="../examples/login-v2.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Login v2</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/register-v2.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Register v2</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/forgot-password-v2.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Forgot Password v2</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../examples/recover-password-v2.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Recover Password v2</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="../examples/lockscreen.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Lockscreen</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/legacy-user-menu.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Legacy User Menu</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/language-menu.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Language Menu</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/404.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Error 404</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/500.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Error 500</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/pace.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Pace</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../examples/blank.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Blank Page</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../../starter.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Starter Page</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-search"></i>
						<p>
							Search
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="../search/simple.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Simple Search</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../search/enhanced.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Enhanced</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">MISCELLANEOUS</li>
				<li class="nav-item">
					<a href="../../iframe.html" class="nav-link">
						<i class="nav-icon fas fa-ellipsis-h"></i>
						<p>Tabbed IFrame Plugin</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="https://adminlte.io/docs/3.1/" class="nav-link">
						<i class="nav-icon fas fa-file"></i>
						<p>Documentation</p>
					</a>
				</li>
				<li class="nav-header">MULTI LEVEL EXAMPLE</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fas fa-circle nav-icon"></i>
						<p>Level 1</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-circle"></i>
						<p>
							Level 1
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Level 2</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Level 2
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Level 3</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Level 3</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Level 3</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Level 2</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fas fa-circle nav-icon"></i>
						<p>Level 1</p>
					</a>
				</li>
				<li class="nav-header">LABELS</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-circle text-danger"></i>
						<p class="text">Important</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-circle text-warning"></i>
						<p>Warning</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-circle text-info"></i>
						<p>Informational</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>