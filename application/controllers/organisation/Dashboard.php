<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/OrganisationController.php');

class Dashboard extends OrganisationController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['UserService', 'OrganisationDashboardService']);
	}

	public function index()
	{
		$this->data['title']         = "Organisation";
		$this->data['PageTitle']     = "Organisation Dashboard";
		$this->data['dashboard']     = 'active';
		$this->data['org_details']   = $this->getObjOrgDasboardService()->fetchTotalOfClusterCenterAnimatorSuByOrgId($this->getOrgId());
		$this->data['activities']    = $this->getObjOrgDasboardService()->fetchTotalOfActivitiesByOrgId($this->getOrgId());
		$this->data['content']       = $this->load->view('organisation/home', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}
}
