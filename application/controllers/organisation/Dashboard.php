<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	private $user_id;
	private $objUserService;
	public $OrgDashService;

	public function __construct()
	{
		parent::__construct();
		// Load User Service and Dashboard Service
		$this->load->library(['UserService', 'OrgnisatonDashboardService' => 'OrgDashService']);

		// Autenticate User
		if (
			$this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != Userrole::ORGANISATION
		) {
			redirect('login');
		}
		$this->user_id								= $this->session->userdata('user_id');
		$this->objUserService					= new $this->userservice();
		$this->OrgDashService					= new $this->OrgDashService();
		$this->data['organisation']		= $this->objUserService->fetchOrganisationHeadDetailsByUserId($this->user_id);
		$this->data['user_role_list'] = $this->objUserService->getUserRoleListAsArray();
	}

	public function index()
	{
		$this->data['title'] 			= "Orgainisation";
		$this->data['PageTitle']	= "Orgainisation Dashboard";
		$this->data['dashboard'] 	= 'active';
		$this->data['details']		=	$this->OrgDashService->fetchTotalOfClusterCenterAnimatorSuByOrgId($this->data['organisation']['org_id']);
		#--------------------------------------------------#
		// $this->data['attendence_menu'] = 'menu-open';
		// $this->data['attendence_by_rcc'] = 'active';
		// $this->data['absentee_report'] = 'active';
		#--------------------------------------------------#
		$this->data['content'] = $this->load->view('organisation/home', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}


	public function profile()
	{
		$this->data['title']				= display('profile');
		$this->data['PageTitle'] 		=	"User Profile";
		$this->data['profile_active']		=	'active';
		#------------------------------# 
		$this->data['user'] 				=	$this->objUserService->fetchLogedInUserDetails();

		$this->data['content'] 			=	$this->load->view('organisation/profile', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
		// $this->load->view('organisation/starter/starter_layout', $this->data);
		// $this->data['content'] = 		$this->load->view('organisation/profile-validation', $this->data,true);
		// $this->data['content'] = $this->load->view('organisation/profile-validation', $this->data);
	}

	public function email_check($email, $user_id)
	{
		$emailExists = $this->db->select('email')
			->where('email', $email)
			->where_not_in('user_id', $user_id)
			->get('student')
			->num_rows();

		if ($emailExists > 0) {
			$this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
			return false;
		} else {
			return true;
		}
	}

	private function validations()
	{
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		// $this->form_validation->set_rules('lastname', display('last_name'),'required|max_length[50]');

		$this->form_validation->set_rules('email', display('email'), "required|max_length[50]|valid_email|callback_email_check[$this->user_id]");

		$this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');

		$this->form_validation->set_rules('phone', display('phone'), 'max_length[20]');
		$this->form_validation->set_rules('mobile', display('mobile'), 'required|max_length[20]');
		$this->form_validation->set_rules('blood_group', display('blood_group'), 'max_length[10]');
		$this->form_validation->set_rules('sex', display('sex'), 'required|max_length[10]');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'max_length[10]');
		//$this->form_validation->set_rules('address',display('address'),'required|max_length[255]');
		$this->form_validation->set_rules('status', display('status'), 'required');

		$this->form_validation->set_error_delimiters('<p class="text-sm mb-0">', '</p>');
	}
	// Profile Edit
	public function form()
	{
		$this->data['title'] = display('edit_profile');
		#-------------------------------#
		$this->validations();
		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'uploads/admin/profilepic/',
			'picture'
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
		#-------------------------------# 
		$this->data['user'] = (object) $postData = [
			'user_id' => $this->input->post('user_id'),
			'firstname' => $this->input->post('firstname', true),
			'mobile' => $this->input->post('mobile', true),
			'email' => /*"std".$this->randStrGen(3,4)."@gmail.com",// */ $this->input->post('email'),
			//'user_role'     => $this->input->post('user_role'),
			'picture' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
			'password' => md5($this->input->post('password')),
			'district' => $this->input->post('district'),
			'block' => $this->input->post('block'),
			'village' => $this->input->post('village'),
			'age' => $this->input->post('age'),
			'sex' => $this->input->post('sex'),
			//'created_by'    => $this->session->userdata('user_id'),
			//'create_date'   => date('Y-m-d'),
			'update_date' => date('Y-m-d'), //$this->input->post('update_date'),
			//'status'        => 1 //$this->input->post('status')
			/*
						'user_id'      => $this->input->post('user_id',true),
						'firstname'    => $this->input->post('firstname',true),
						'lastname'     => $this->input->post('lastname',true),
						'designation'  => $this->input->post('designation',true),
						'department_id' => $this->input->post('department_id',true),
						'address'      => $this->input->post('address',true),
						'phone'        => $this->input->post('phone',true),
						'mobile'       => $this->input->post('mobile',true),
						'email'        => $this->input->post('email',true),
						'password'     => md5($this->input->post('password',true)),
						'short_biography' => $this->input->post('short_biography',true),
						'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
						'specialist'   => $this->input->post('specialist',true),
						'date_of_birth' => date('Y-m-d', strtotime($this->input->post('date_of_birth',true))),
						'sex'          => $this->input->post('sex',true),
						'blood_group'  => $this->input->post('blood_group',true),
						'degree'       => $this->input->post('degree',true),
						'created_by'   => $this->session->userdata('user_id'),
						'create_date'  => date('Y-m-d'),
						'status'       => $this->input->post('status',true),*/
		];
		//$this->data['student'] = (object)$postData;
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			if ($this->user_model->update($postData)) {
				#set success message
				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}

			//update profile picture
			if ($postData['user_id'] == $this->session->userdata('user_id')) {
				$this->session->set_userdata([
					'picture' => $postData['picture'],
					'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
				]);
			}
			redirect('organisation/dashboard/profile/');
		} else {
			$this->user_id = $this->session->userdata('user_id');
			$this->data['user'] = $this->dashboard_model->profile($this->user_id);
			$this->data['user_role_list'] = $this->userrole_model->read_basic_as_list();
			$this->data['content'] = $this->load->view('organisation/profile', $this->data, true);
			$this->load->view('organisation/starter/starter_layout', $this->data);
		}
	}
}
