<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/DashboardController.php');

class CDashboard extends DashboardController
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->library(['UserService', 'OrganisationDashboardService']);
	}

	public function index()
	{
		$this->data['title'] = "Organisation";
		$this->data['PageTitle'] = "Organisation Dashboard";
		$this->data['dashboard'] = 'active';
		$this->data['details'] = $this->fetchTotalOfCenterAnimatorStudentMessageByOrgIdByClusterId($this->getOrgId(), $this->getClusterId());
		$this->renderView('coordinator/home', $this->data);
	}
}
