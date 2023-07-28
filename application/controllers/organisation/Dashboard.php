<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/OrganisationController.php');

class Dashboard extends OrganisationController
{
	public function __construct()
	{
		parent::__construct();
		// Load OrgnisatonDashboardService from the parent controller
		
	}

	private function loadDashboardData()
	{
		$this->data['title'] = "Organisation";
		$this->data['PageTitle'] = "Organisation Dashboard";
		$this->data['dashboard'] = 'active';
		
	}

	public function index()
	{
		$this->loadDashboardData();
		$this->data['content'] = $this->load->view('organisation/home', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function profile()
	{
		$this->data['title'] = display('profile');
		$this->data['PageTitle'] = "User Profile";
		$this->data['profile_active'] = 'active';

		$this->data['user'] = $this->objUserService->fetchLogedInUserDetails();
		$this->data['content'] = $this->load->view('organisation/profile', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function form()
	{
		parent::form();

		$this->data['title'] = display('edit_profile');
		$this->validateForm();

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
					if ($postData['userId'] == $this->session->userdata('userId')) {
						$this->session->set_userdata([
							'picture' => $postData['picture'],
							'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
						]);
					}

					// Redirect to the profile page
					redirect('organisation/dashboard/profile/');
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

	// Other methods can be defined here.
	public function email_check($email, $userId)
	{
		$emailExists = $this->db->select('email')
			->where('email', $email)
			->where_not_in('userId', $userId)
			->get('student')
			->num_rows();

		if ($emailExists > 0) {
			$this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
			return false;
		} else {
			return true;
		}
	}
	private function validateForm()
	{
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		// Add other form validation rules here.
		$this->form_validation->set_rules('email', display('email'), 'trim|required|max_length[50]|valid_email|callback_email_check[' . $this->userId . ']');
		$this->form_validation->set_rules('password', display('password'), 'trim|required|max_length[32]|md5');
		$this->form_validation->set_rules('phone', display('phone'), 'trim|max_length[20]');
		$this->form_validation->set_rules('mobile', display('mobile'), 'trim|required|max_length[20]');
		$this->form_validation->set_rules('blood_group', display('blood_group'), 'trim|max_length[10]');
		$this->form_validation->set_rules('sex', display('sex'), 'trim|required|max_length[10]');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'trim|max_length[10]');
		$this->form_validation->set_rules('status', display('status'), 'trim|required');

		// Set custom error delimiters for form validation errors
		$this->form_validation->set_error_delimiters('<p class="text-sm mb-0">', '</p>');
	}
}
