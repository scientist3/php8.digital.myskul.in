<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrganisationController extends CI_Controller
{
	public $userId;
	protected $data = array();
	public $session;
	public $objUserService;
	public $objDasboardService;
	public $form_validation;
	public $formData;

	public function __construct()
	{
		parent::__construct();

		// Load necessary libraries, User Service and Dashboard Service
		$this->load->library(['UserService', 'OrganisationDashboardService']);
		$this->load->library('session');

		// Authenticate User
		$this->authenticateUser();
		// Load Common Data;
		$this->loadCommonData();
	}

	private function authenticateUser()
	{
		// Authenticate User
		if (
			$this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != Userrole::ORGANISATION
		) {
			redirect('login');
			throw new Exception("User not logged in or invalid role");
		}
	}

	// Add other methods specific to OrganisationController here.
	private function loadCommonData()
	{
		$this->session 								= $this->session;
		$this->userId									= $this->session->userdata('user_id');
		$this->objUserService					= $this->userservice;
		$this->objDasboardService			= $this->OrgnisatonDashboardService;
		// Load Data for Views
		$this->data['organisation']		= $this->objUserService->fetchOrganisationHeadDetailsByUserId($this->userId);
		$this->data['user_role_list']	= $this->objUserService->getUserRoleListAsArray();

		$this->data['org_etails'] 		= $this->objDasboardService->fetchTotalOfClusterCenterAnimatorSuByOrgId($this->data['organisation']['org_id']);
	}

	public function form()
	{
		$this->load->library('form_validation');
		$this->form_validation	= $this->form_validation;
		$this->formData 				= $this->input->post();
	}
	private function loadFormData()
	{
	}
}
