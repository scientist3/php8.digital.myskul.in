<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginBackup extends CI_Controller
{
	private $data;
	private $postData;
	private $objUserService;
	private $user_role;


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

		$this->objUserService	= new $this->userservice();
		$this->data['user_role_list'] = $this->objUserService->getUserRoleListAsArray();
		$this->user_role = $this->session->userdata('user_role');
	}
	public function index()
	{
		$this->login();
	}
	public function login()
	{

		if ($this->session->userdata('isRepLogIn'))
			$this->redirectTo($this->session->userdata('user_role'));

		$this->validation();
		$this->loadData();
		$this->loadInputData();

		if (true === $this->validate()) {
			$this->user_role = $this->postData['user_role'];
			$this->redirectTo($this->postData['user_role']);
		} else {
			//$this->data['user_role_list'] = $this->userrole_model->read_basic_as_list();
			$this->load->view('login/login_wrapper', $this->data);
		}
	}

	private function loadData()
	{
		// Load setting Data
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
	private function validation()
	{
		// Validation rules definition
		$this->form_validation->set_rules('email', display('email'), 'required|max_length[50]|valid_email');
		$this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');
		$this->form_validation->set_rules('user_role', display('user_role'), 'required');
	}
	private function validate()
	{

		if ($this->form_validation->run() === true) {
			$check_user = $this->login_model->check_user($this->postData);
			if ($check_user->num_rows() === 1) {

				// Only when cluster head logins
				if ($this->postData['user_role'] == 3 && empty($check_user->row()->cluster_idd)) {
					$this->session->set_flashdata('exception', 'Cluster not assigned yet. Please Contact organisation head/admin.');
					redirect('login');
				}

				if ($this->postData['user_role'] == 4 && empty($check_user->row()->org_idd)) {
					$this->session->set_flashdata('exception', 'organisation not assigned yet. Please Contact organisation head/cluster head/admin.');
					redirect('login');
				}

				if ($this->postData['user_role'] == 4 && empty($check_user->row()->cluster_idd)) {
					$this->session->set_flashdata('exception', 'Cluster not assigned yet. Please Contact organisation head/cluster head/admin.');
					redirect('login');
				}
				//print_r($check_user->row());die;
				$this->session->set_userdata([
					'isRepLogIn' => true,
					'user_id' => (($this->postData['user_role'] == 10) ? $check_user->row()->id : $check_user->row()->user_id),
					'patient_id' => (($this->postData['user_role'] == 10) ? $check_user->row()->patient_id : null),
					'email' => $check_user->row()->email,
					'fullname' => $check_user->row()->firstname,
					'user_role' => (($this->postData['user_role'] == 10) ? 10 : $check_user->row()->user_role),
					'picture' => $check_user->row()->picture,
					'class' => $check_user->row()->class,
					'org_id' => $check_user->row()->org_idd,
					'cluster_id' => $check_user->row()->cluster_idd,
					'create_date' => $check_user->row()->create_date,
					/* Saving Setting Into Session*/
					'title' => (!empty($setting->title) ? $setting->title : null),
					'address' => (!empty($setting->description) ? $setting->description : null),
					'logo' => (!empty($setting->logo) ? $setting->logo : null),
					'favicon' => (!empty($setting->favicon) ? $setting->favicon : null),
					'footer_text' => (!empty($setting->footer_text) ? $setting->footer_text : null),
				]);
				return true;
				// can directy redirect here
			} else {
				$this->session->set_flashdata('exception', display('incorrect_email_password'));
				return false;
			}
		}
	}
	public function redirectTo($user_role = null)
	{
		$this->save_login_time();
		switch ($user_role) {
				// case Userrole::ADMIN:
				// 	redirect('dashboard_admin/dashboard_cfo/index'); // Admin-   CFO
				// 	break;
			case Userrole::ORGANISATION:
				redirect('organisation/dashboard/index'); // Coordinator
				break;
			case Userrole::CLUSTER_COORDINATOR:
				redirect('dashboard_cor/dashboard_cor/index'); // Coordinator
				break;
			case Userrole::ANIMATOR:
				redirect('dashboard_ani/dashboard_ani/index'); // animator
				break;
			case Userrole::STUDENT:
				redirect('dashboard_std/dashboard_std/index'); // Student
				break;
			default:
				redirect('login');
				break;
		}
	}
	public function save_login_time()
	{
		# save if not recorded for today
		$user_id = $this->session->userdata('user_id');
		$user_role = $this->session->userdata('user_role');

		$this->login_model->save_login_time($user_id, $user_role);
	}
	public function developer()
	{
		$this->load->view('profile3');
	}
	public function save_logout_time()
	{
		# save if not
		$user_id = $this->session->userdata('user_id');
		$user_role = $this->session->userdata('user_role');

		$this->login_model->save_logout_time($user_id, $user_role);
	}
	public function logout()
	{
		$this->save_logout_time();
		$this->session->sess_destroy();
		$this->session->set_userdata(['user_role', $this->user_role]);
		redirect('login');
	}
}
