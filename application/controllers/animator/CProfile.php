<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/animator/Animator.php');

class CProfile extends Animator
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

		$this->data['user'] = $this->fetchLogedInUserDetails();
		$this->renderView('animator/profile/index', $this->data);
	}

	public function saveProfile()
	{
		//parent::prepareData();
		$this->data['title'] = display('edit_profile');
		$this->data['PageTitle'] = "User Profile";
		$this->data['profile_active'] = 'active';

		$postData = $this->getObjProfile()->toArray();

		$this->validateProfileForm();
		// Check if the form is submitted
		if ($postData) {
				$this->updateProfile($postData);
		}

		// Load the view files
		$this->data['user'] = $this->fetchLogedInUserDetails();
		$this->renderView('animator/profile/index', $this->data);
	}

	private function getObjProfile()
	{
		$objProfile = new Profile();
		$objProfile->setValues($this->input->post());
		$picture = $this->uploadPicture();
		if (!empty($picture)) {
			$objProfile->setPicture($picture);
		}
		return $objProfile;
	}
	public function email_check($email, $userId)
	{
		$emailExists = $this->db->select('email')
			->where('email', $email)
			->where_not_in('user_id', $userId)
			->get('student')
			->num_rows();

		if ($emailExists > 0) {
			$this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
			return false;
		} else {
			return true;
		}
	}
	public function validateProfileForm()
	{
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		// Add other form validation rules here.
		$this->form_validation->set_rules('email', display('email'), 'trim|required|max_length[50]|valid_email|callback_email_check[' . $this->getUserId() . ']');
		$this->form_validation->set_rules('password', display('password'), 'trim|required|max_length[32]|md5');
		$this->form_validation->set_rules('phone', display('phone'), 'trim|max_length[20]');
		$this->form_validation->set_rules('mobile', display('mobile'), 'trim|required|max_length[20]');
		$this->form_validation->set_rules('blood_group', display('blood_group'), 'trim|max_length[10]');
		$this->form_validation->set_rules(
			'sex',
			display('sex'),
			'trim|required|max_length[10]'
		);
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'trim|max_length[10]');
		$this->form_validation->set_rules('status', display('status'), 'trim|required');

		// Set custom error delimiters for form validation errors
		$this->form_validation->set_error_delimiters('<p class="text-sm mb-0">', '</p>');
	}
	public function updateProfile($postData)
	{
		if ($this->form_validation->run() === true) {

			// Update the user profile
			if ($this->userModel->update($postData)) {
				// Set success message
				$this->session->set_flashdata('message', display('update_successfully'));

				// Update session data if the profile being updated is the current user's
				if ($postData['user_id'] == $this->session->userdata('user_id')) {
					$this->session->set_userdata([
						'picture' => $postData['picture'],
						'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
					]);
				}

				// Redirect to the profile page
				redirect('animator/cprofile/');
			} else {
				// Set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
		}
	}

	public function uploadPicture($path = "uploads/animator/profilepic/", $fieldname = 'picture'): ?string
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
			return null;
		}
		return $picture;
	}
}
	class Profile {
		private $userId;
		private $firstName;
		private $email;
		private $password;
		private $mobile;
		private $sex;
		private $picture;
		private $oldPicture;
		private $status;
		public function getUserId() {
			return $this->userId;
		}

		public function getFirstName() {
			return $this->firstName;
		}

		public function getEmail() {
			return $this->email;
		}

		public function getPassword() {
			return $this->password;
		}

		public function getMobile() {
			return $this->mobile;
		}

		public function getSex() {
			return $this->sex;
		}

		public function getPicture() {
			return $this->picture;
		}
		public function setPicture($pic) {
			$this->picture = $pic;
		}

		public function getOldPicture() {
			return $this->oldPicture;
		}

		public function getStatus() {
			return $this->status;
		}

//		public function __construct() {
//			$this->userId = $this->input->post('user_id');
//			$this->firstName = $this->input->post('firstname');
//			$this->email = $this->input->post('email');
//			$this->password = $this->input->post('password');
//			$this->mobile = $this->input->post('mobile');
//			$this->sex = $this->input->post('sex');
//			$this->picture = $this->input->post('old_picture');
//			//$this->oldPicture = $this->input->post('old_picture');
//			$this->status = $this->input->post('status');
//		}

		public function setValues($postData) {
			$this->userId = $postData['user_id'];
			$this->firstName = $postData['firstname'];
			$this->email = $postData['email'];
			$this->password = $postData['password'];
			$this->mobile = $postData['mobile'];
			$this->sex = $postData['sex'];
			$this->picture = $postData['picture']??$postData['old_picture'];
			$this->oldPicture = $postData['old_picture'];
			$this->status = $postData['status'];
		}

		public function toArray() {
			$data = array(
				'user_id' => $this->getUserId(),
				'firstname' => $this->getFirstName(),
				'email' => $this->getEmail(),
				'password' => $this->getPassword(),
				'mobile' => $this->getMobile(),
				'sex' => $this->getSex(),
				'picture' => $this->getPicture(),
				//'old_picture' => $this->getOldPicture(),
				'status' => $this->getStatus()
			);
			if($this->getPassword()=='' || empty($this->getPassword())){
				unset($data['password']);
			}
			return $data;
		}
	}


