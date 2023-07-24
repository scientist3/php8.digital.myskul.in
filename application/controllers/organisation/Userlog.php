<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userlog extends CI_Controller
{
	private $user_id;
	private $objUserService;
	private $data;


	public function __construct()
	{
		parent::__construct();
		// Load UserService
		$this->load->library('UserService');
		// Load Models
		$this->load->model(
			array(
				'organisation/user1_model',
				'dashboard_model',
			)
		);

		// Autenticate User
		if (
			$this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != Userrole::ORGANISATION
		) {
			redirect('login');
		}

		$this->user_id								= $this->session->userdata('user_id');
		$this->objUserService					= new $this->userservice();
		$this->data['organisation'] 	= $this->objUserService->fetchOrganisationHeadDetailsByUserId($this->user_id);
		$this->data['user_role_list'] = $this->objUserService->getUserRoleListAsArray();
		$this->data['designation'] 		= $this->objUserService->getUserRoleBasicAsDesignationListAsArray();
		$this->data['district_list']	= $this->objUserService->getDistrictListAsArray();
	}

	public function index()
	{
		$this->data['title']							= 'Attendence Report';
		$this->data['PageTitle']					= 'Attendence Report';
		$this->data['attendence_menu']		= 'menu-open';
		$this->data['attendence_by_rcc']	= 'active';
		$this->data['pdfFileName'] 				= 'Attendence Report of Organisation - ' . $this->data['organisation']['org_name'];

		/* ----------------------------------------------  */
		$this->data['cluster_id']			= $this->input->post('cluster_id');
		$this->data['center_id']			= $this->input->post('center_id');
		$this->data['user_role']			= !empty($this->input->post('user_role')) ? $this->input->post('user_role') : '4';
		$this->data['date']						= !empty($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
		/******************** User Data **************************/
		$this->data['users']					= $this->objUserService->fetchUserAttendenceByOrgIdByClusterIdByCenterByUserRoleByDateByUserId(
			$this->data['organisation']['org_id'],
			$this->data['cluster_id'],
			$this->data['center_id'],
			$this->data['user_role'],
			$this->data['date'],
			$this->user_id
		);

		$this->data['cluster_list'] =
			$this->objUserService->fetchClustersByOrgIdAsList($this->data['organisation']['org_id']);

		$this->data['center_list'] = $this->objUserService->fetchCentersByClusterIdAsList($this->data['cluster_list']);

		$this->data['content'] = $this->load->view('organisation/userlog/member-new', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function view($user_id)
	{

		$this->data['title'] = 'Attendence Report';
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['end_date'] = !empty($this->input->post('end_date')) ? $this->input->post('end_date') : date('Y-m-d');
		$this->data['start_date'] = !empty($this->input->post('start_date')) ? $this->input->post('start_date') : date('Y-m-d', strtotime($this->data['end_date'] . '-3 days'));
		$this->data['user_id'] = $user_id;
		$this->data['users'] = $this->user1_model->user_log_from_to_date(
			$this->data['user_id'],
			$this->data['start_date'],
			$this->data['end_date']
		);
		$this->data['content'] = $this->load->view('organisation/userlog/view', $this->data, true);
		$this->load->view('organisation/layout/main_wrapper_lte', $this->data);
	}

	public function absent()
	{
		$this->data['title']						=  $this->data['PageTitle'] = 'Absentees  Report';
		$this->data['attendence_menu']	= 'menu-open';
		$this->data['absentees_report']	= 'active';
		$this->data['pdfFileName'] 			= 'Absentees Report of Organisation - ' . $this->data['organisation']['org_name'];

		/* ----------------------------------------------  */
		$this->data['cluster_id'] = $this->input->post('cluster_id');
		$this->data['center_id'] = $this->input->post('center_id');
		$this->data['user_role'] = !empty($this->input->post('user_role')) ? $this->input->post('user_role') : '4';
		$this->data['date'] = !empty($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');

		$this->data['users'] =
			$this->objUserService->fetchUserAbsenteesByOrgIdByClusterIdByCenterByUserRoleByDateByUserId(
				$this->data['organisation']['org_id'],
				$this->data['cluster_id'],
				$this->data['center_id'],
				$this->data['user_role'],
				$this->data['date'],
				$this->user_id
			);

		$this->data['cluster_list'] =
			$this->objUserService->fetchClustersByOrgIdAsList($this->data['organisation']['org_id']);

		$this->data['center_list'] = $this->objUserService->fetchCentersByClusterIdAsList($this->data['cluster_list']);

		$this->data['content'] = $this->load->view('organisation/userlog/absent_member-new', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function viewabsent($user_id)
	{
		$this->data['title'] = 'Absentee Report';
		$this->data['user_role_list'] = $this->dashboard_model->get_user_roles();
		$this->data['end_date'] = !empty($this->input->post('end_date')) ? $this->input->post('end_date') : date('Y-m-d');
		$this->data['start_date'] = !empty($this->input->post('start_date')) ? $this->input->post('start_date') : date('Y-m-d', strtotime($this->data['end_date'] . '-3 days'));
		$this->data['user_id'] = $user_id;
		$this->data['users'] = $this->user1_model->user_absentee_log_from_to_date(
			$this->data['user_id'],
			$this->data['start_date'],
			$this->data['end_date']
		);
		$this->data['content'] = $this->load->view('organisation/userlog/absent_view', $this->data, true);
		$this->load->view('organisation/layout/main_wrapper_lte', $this->data);
	}
}
