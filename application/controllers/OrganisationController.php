<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrganisationController extends CI_Controller
{
	// Define all the fields of the users table
	private $userId;
	public $data = array();
	// private $session;
	private $objUserService;
	private $objOrgDasboardService;
	private $objFileUpload;
	// private $form_validation;
	private $formData;

	public function __construct()
	{
		parent::__construct();

		// Load necessary libraries, User Service and Dashboard Service
		$this->load->library(['UserService', 'OrganisationDashboardService']);
		$this->load->library(['session']);

		// Load Common Data;
		$this->loadCommonData();
		// Authenticate User
		$this->authenticateUser();
	}

	private function authenticateUser()
	{
		// Authenticate User
		if (
			$this->session->userdata('isRepLogIn') == false
			|| $this->session->userdata('user_role') != Userrole::ORGANISATION
		) {
			redirect('login');
			// throw new Exception("User not logged in or invalid role");
		}
	}

	// Add other methods specific to OrganisationController here.
	private function loadCommonData()
	{
		// var_dump($this->ObjSession);
		// $this->session 								= $this->ObjSession;
		$this->userId									= $this->session->userdata('user_id');
		$this->objUserService					= $this->userservice;
		$this->objOrgDasboardService	= $this->organisationdashboardservice;
		$this->objFileUpload					= $this->fileupload;
		// Load Data for Views
		$this->data['organisation']		= $this->objUserService->fetchOrganisationHeadDetailsByUserId($this->getUserId());
		$this->data['user_role_list']	= $this->objUserService->getUserRoleListAsArray();

		// $this->data['org_details'] 		= $this->objOrgDasboardService->fetchTotalOfClusterCenterAnimatorSuByOrgId($this->data['organisation']['org_id']);
	}

	//  TODO: Use in Service or prepare data only
	public function prepareData()
	{
		$this->load->library('form_validation');
		// $this->form_validation	= $this->form_validation;
		$this->formData 				= $this->input->post();
	}

	/* --------------------- Section CProfile Controller ----------------------- */
	public function email_check($email, $userId)
	{
		return $this->objUserService->email_check($email, $userId);
	}

	public function validateProfileForm()
	{
		return $this->objUserService->validateProfileForm();
	}
	// TODO: Need Attention: may need to relocate
	public function uploadPicture($fieldname = 'picture', $path = "uploads/organisation/profilepic/"): string
	{
		//picture upload
		$picture = $this->fileupload->do_upload(
			$path,
			$fieldname
		);
		// if picture is uploaded then resize the picture
		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize(
				$picture,
				200,
				200
			);
		}
		//if picture is not uploaded
		if ($picture === false) {
			$this->session->set_flashdata('exception', display('invalid_picture'));
		}
		return $picture;
	}

	/* --------------------- Section CAttendance Controller ----------------------- */

	// Getters
	public function getUserId()
	{
		return $this->userId;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getSession()
	{
		return $this->session;
	}

	public function getObjUserService()
	{
		return $this->objUserService;
	}

	public function getObjOrgDasboardService()
	{
		return $this->objOrgDasboardService;
	}

	public function getObjFileUpload()
	{
		return $this->objFileUpload;
	}

	public function getFormData()
	{
		return $this->formData;
	}

	// Setters
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function setSession($session)
	{
		$this->session = $session;
	}

	public function setObjUserService($objUserService)
	{
		$this->objUserService = $objUserService;
	}

	public function setObjOrgDasboardService($objOrgDasboardService)
	{
		$this->objOrgDasboardService = $objOrgDasboardService;
	}

	public function setObjFileUpload($objFileUpload)
	{
		$this->objFileUpload = $objFileUpload;
	}

	public function setFormData($formData)
	{
		$this->formData = $formData;
	}

	// toArray() function to convert object properties to an array
	public function toArray()
	{
		return array(
			'userId' => $this->getUserId(),
			'data' => $this->getData(),
			'objUserService' => $this->getObjUserService(),
			'objOrgDasboardService' => $this->getObjOrgDasboardService(),
			'objFileUpload' => $this->getObjFileUpload(),
			'formData' => $this->getFormData(),
		);
	}
}
