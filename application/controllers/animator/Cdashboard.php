<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	require(APPPATH . 'controllers/animator/DashboardController.php');

	class Cdashboard extends DashboardController
	{
		public function __construct()
		{
			parent::__construct();
			//$this->load->library(['UserService', 'OrganisationDashboardService']);
		}

		public function index()
		{
			$this->data['title']              = "Dashboard";
			$this->data['PageTitle']          = "Animator Dashboard";
			$this->data['dashboard']          = 'active';
			$this->data['allocated_centers']  = $this->getAllocatedCentersAsListWithAll();
			$this->data['details']            = $this->fetchTotalOfStudentMessageCenterByOrgIdByClusterId( $this->getOrgId(), $this->getClusterId(),$this->getActiveCenterIdAsArray() );
			$this->renderView('animator/home', $this->data);
		}

		public function updateActiveCenterId(): void
		{
			$active_center_id = $this->input->post('active_center_id');

			// Update the session data
			$this->session->set_userdata('active_center_id', $active_center_id);

			// Return a response if needed (e.g., success message)
			echo json_encode(array('status' => 'success', 'message' => 'Session data updated successfully'));
		}
	}
