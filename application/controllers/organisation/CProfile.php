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

		$this->data['user'] = $this->objUserService->fetchLogedInUserDetails();
		$this->data['content'] = $this->load->view('organisation/profile/index', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function saveProfile()
	{
		parent::prepareData();
		$this->objUser = $this->getObjUserService()->getUserObject();
		$postData = $this->getObjUserService()->objUser->toArraySetOnlyValues();
		$this->data['title'] = display('edit_profile');
		$this->validateForm();
		var_dump($this->getFormData());
		// var_dump($this->objUser);
		var_dump($postData);
		// Check if the form is submitted
		if ($this->formData) {

			// Validate the form inputs
			if ($this->form_validation->run() === true) {
				// Form validation passed, handle form data
				// Other form handling code...
				// ...

				// Update the user profile
				if ($this->user_model->update($postData)) {
					// Set success message
					$this->session->set_flashdata('message', display('update_successfully'));

					// Update session data if the profile being updated is the current user's
					if ($postData['user_id'] == $this->session->userdata('userId')) {
						$this->session->set_userdata([
							'picture' => $postData['picture'],
							'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
						]);
					}

					// Redirect to the profile page
					redirect('organisation/cprofile/');
				} else {
					// Set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			}
		}

		// Load the view files
		$this->data['user'] = $this->dashboard_model->profile($this->userId);
		$this->data['user_role_list'] = $this->userrole_model->read_basic_as_list();
		$this->data['content'] = $this->load->view('organisation/profile', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}
}
