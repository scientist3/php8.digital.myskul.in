<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/OrganisationController.php');

class CProfile extends OrganisationController
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library(['UserService']);
	}

	public function index()
	{
		$this->data['title'] = display('profile');
		$this->data['PageTitle'] = "User Profile";
		$this->data['profile_active'] = 'active';

		$this->data['user'] = $this->getObjUserService()->fetchLogedInUserDetails();
		$this->data['content'] = $this->load->view('organisation/profile/index', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function saveProfile()
	{
		parent::prepareData();
		$this->data['title'] = display('edit_profile');
		$this->data['PageTitle'] = "User Profile";
		$this->data['profile_active'] = 'active';
		
		$this->objUser = $this->getObjUserService()->getUserObject();
		$postData = $this->objUser->toArraySetOnlyValues();

		$this->getObjUserService()->validateProfileForm();
		// Check if the form is submitted
		if ($postData) {
				$this->getObjUserService()->saveProfile($postData);
		}

		// Load the view files
		$this->data['user'] = $this->getObjUserService()->fetchLogedInUserDetails();
		// $this->data['user_role_list'] = $this->userrole_model->read_basic_as_list();
		$this->data['content'] = $this->load->view('organisation/profile/index', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}
}
