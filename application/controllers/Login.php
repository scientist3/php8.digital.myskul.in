<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Login extends CI_Controller
	{
		private $data;
		private $postData;
		private $userService;
		private $userRole;

		public function __construct()
		{
			parent::__construct();
			$this->load->library('UserService');
			$this->load->model(
				array(
					'userrole_model',
					'login_model',
					'setting_model',
				)
			);

			$this->userService = new $this->userservice();
			$this->data['user_role_list'] = $this->userService->getUserRoleListAsArray();
			$this->userRole = $this->session->userdata('user_role');
		}

		public function index()
		{
			if ($this->session->userdata('isRepLogIn')) {
				$this->redirectToUserRole($this->session->userdata('user_role'));
			}

			$this->validateLoginForm();
			$this->loadSettings();
			$this->loadInputData();

			if ($this->isLoginFormValid()) {
				$this->userRole = $this->postData['user_role'];
				$this->redirectToUserRole($this->postData['user_role']);
			} else {
				$this->load->view('login/login_wrapper', $this->data);
			}
		}

		private function loadSettings()
		{
			$setting = $this->setting_model->read();

			$this->data['title'] = (!empty($setting->title) ? $setting->title : null);
			$this->data['logo'] = (!empty($setting->logo) ? $setting->logo : null);
			$this->data['favicon'] = (!empty($setting->favicon) ? $setting->favicon : null);
			$this->data['footer_text'] = (!empty($setting->footer_text) ? $setting->footer_text : null);
		}

		private function loadInputData()
		{
			$this->data['user'] = (object) $this->postData = [
				'email' => $this->input->post('email', true),
				'password' => !empty($this->input->post('password', true)) ? md5($this->input->post('password', true)) : NULL,
				'user_role' => $this->input->post('user_role', true),
			];
		}

		private function validateLoginForm()
		{
			$this->form_validation->set_rules('email', display('email'), 'required|max_length[50]|valid_email');
			$this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');
			$this->form_validation->set_rules('user_role', display('user_role'), 'required');
		}

		private function isLoginFormValid()
		{
			if ($this->form_validation->run() === true) {
				$user = $this->login_model->check_user($this->postData);

				if ($user->num_rows() === 1) {
					$this->handleSuccessfulLogin($user->row());
					return true;
				} else {
					$this->session->set_flashdata('exception', display('incorrect_email_password'));
					return false;
				}
			}
			return false;
		}

		private function handleSuccessfulLogin($user)
		{
			// ... (Set session data for user)
			$this->session->set_userdata([
				'isRepLogIn' => true,
				'user_id' => $user->user_id,
				'email' => $user->email,
				'fullname' => $user->firstname,
				'user_role' => ($this->postData['user_role'] == Userrole::STUDENT) ? Userrole::STUDENT : $user->user_role,
				'picture' => $user->picture,
				'class' => $user->class,
				'org_id' => $user->org_idd,
				'cluster_id' => $user->cluster_idd,
				'create_date' => $user->create_date,
				/* Saving Setting Into Session*/
				'title' => (!empty($setting->title) ? $setting->title : null),
				'address' => (!empty($setting->description) ? $setting->description : null),
				'logo' => (!empty($setting->logo) ? $setting->logo : null),
				'favicon' => (!empty($setting->favicon) ? $setting->favicon : null),
				'footer_text' => (!empty($setting->footer_text) ? $setting->footer_text : null),
			]);
		}

		public function redirectToUserRole($userRole = null)
		{
			$this->saveLoginTime();

			switch ($userRole) {
				case Userrole::ORGANISATION:
					redirect('organisation/dashboard/index'); // Coordinator
					break;
				case Userrole::CLUSTER_COORDINATOR:
					redirect('coordinator/cdashboard/index'); // Coordinator
					break;
				case Userrole::ANIMATOR:
					redirect('animator/cdashboard/index'); // Animator
					break;
				case Userrole::STUDENT:
					redirect('student/dashboard/index'); // Student
					break;
				default:
					redirect('login');
					break;
			}
		}

		// ... (Other methods)
		public function saveLoginTime()
		{
			# save if not recorded for today
			$user_id = $this->session->userdata('user_id');
			$user_role = $this->session->userdata('user_role');

			//$this->login_model->save_login_time($user_id, $user_role);
		}

		public function developer()
		{
			$this->load->view('profile3');
		}
		public function saveLogoutTime()
		{
			# save if not
			$user_id = $this->session->userdata('user_id');
			$user_role = $this->session->userdata('user_role');

			//$this->login_model->save_logout_time($user_id, $user_role);
		}
		public function logout()
		{
			$this->saveLogoutTime();
			$this->session->sess_destroy();
			$this->session->set_userdata(['user_role', $this->userRole]);
			redirect('login');
		}
	}
