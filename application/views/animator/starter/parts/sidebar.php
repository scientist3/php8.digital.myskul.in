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
					<a href="<?php echo base_url('animator/cdashboard/index') ?>" class="nav-link <?php echo $dashboard ?? null; ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p> Dashboard </p>
					</a>
				</li>
				<!-- Study Material -->
				<li class="nav-item <?php echo $material_menu ?? null; ?>">
					<a href="#" class="nav-link <?php echo isset($material_menu) ? 'active' : null; ?>">
						<i class="nav-icon fa fa-book"></i>
						<p>
							<?php echo display('study_material'); ?>
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("animator/cmaterial/create") ?>" class="nav-link <?php echo $material_add_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('add_material'); ?></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("animator/cmaterial/index") ?>" class="nav-link <?php echo $material_view_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('view_material'); ?></p>
							</a>
						</li>

					</ul>
				</li>

				<li class="nav-item <?php echo $activities_menu ?? null; ?>">
					<a href="#" class="nav-link <?php echo isset($activities_menu) ? 'active' : null; ?>">
						<i class="nav-icon fa fa-user"></i>
						<p><?php echo display('activities'); ?>
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("animator/cactivities/studentSessionListing") ?>" class="nav-link <?php echo $std_sess_comp_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('session_completed_students'); ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("animator/cactivities/studentCncpListing") ?>" class="nav-link <?php echo $cncp_enrolled_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('cncp_enrolled'); ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("animator/cactivities/studentCncpSupportedListing") ?>" class="nav-link <?php echo $cncp_supported_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('cncp_supported'); ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("animator/cactivities/studentPsychoEducatedListing") ?>" class="nav-link <?php echo $psycho_educated_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('psycho_educated'); ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("animator/cactivities/studentPrimaryCounsellingListing") ?>" class="nav-link <?php echo $primary_counselling_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('primary_counseling_status'); ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("animator/cactivities/studentSecondaryCounsellingListing") ?>" class="nav-link <?php echo $sec_ter_serv_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('secondary_tertiary_service'); ?></p>
							</a>
						</li>

            <li class="nav-item">
              <a href="<?php echo base_url("animator/cactivities/studentPsychoSocialWellBeingListing") ?>" class="nav-link <?php echo $psycho_social_well_being_option ?? null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo display('psycho_social_well_being'); ?></p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url("animator/cactivities/studentCarePlanListing") ?>" class="nav-link <?php echo $care_plans_option ?? null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo display('care_plans'); ?></p>
              </a>
            </li>
					</ul>
				</li>

        <!-- Stakeholders -->
        <li class="nav-item <?php echo $stakeholder_menu ?? null; ?>">
          <a href="#" class="nav-link <?php echo isset($stakeholder_menu) ? 'active' : null; ?>">
            <i class="nav-icon fa fa-users"></i>
            <p>
							<?php echo display('stakeholders'); ?>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url("animator/cstakeholder/processStakeholderForm") ?>" class="nav-link <?php echo $add_stakeholders ?? null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo display('add_stakeholders'); ?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url("animator/cstakeholder/index") ?>" class="nav-link <?php echo $list_stakeholders ?? null; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo display('view_stakeholders'); ?></p>
              </a>
            </li>
          </ul>
        </li>
				<!-- Users -->
				<li class="nav-item <?php echo $user_menu ?? null; ?>">
					<a href="#" class="nav-link <?php echo isset($user_menu) ? 'active' : null; ?>">
						<i class="nav-icon fa fa-users"></i>
						<p>
							<?php echo display('users'); ?>
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("animator/cstudent/processStudentForm") ?>" class="nav-link <?php echo $user_add_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('add_student'); ?></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("animator/cstudent/index") ?>" class="nav-link <?php echo $user_list_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('list_student'); ?></p>
							</a>
						</li>
					</ul>
				</li>

				<!-- Message -->
				<li class="nav-item <?php echo $message_menu ?? null; ?>">
					<a href="#" class="nav-link <?php echo isset($message_menu) ? 'active' : null; ?>">
						<i class="nav-icon fa fa-envelope"></i>
						<p>
							<?php echo display('message'); ?>
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("animator/message/new_message") ?>" class="nav-link <?php echo $new_message_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('new_message'); ?></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("animator/message/index") ?>" class="nav-link <?php echo $inbox_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('inbox'); ?></p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("animator/message/sent") ?>" class="nav-link <?php echo $sent_option ?? null; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p><?php echo display('sent'); ?></p>
							</a>
						</li>

					</ul>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
