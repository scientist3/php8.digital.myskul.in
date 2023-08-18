<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/OrganisationController.php');

class Userlog extends OrganisationController
{
	private $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->data['designation'] 		= $this->getObjUserService()->getUserRoleBasicAsDesignationListAsArray();
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
		$this->data['users']					= $this->getObjUserService()->fetchUserAttendenceByOrgIdByClusterIdByCenterByUserRoleByDateByUserId(
			$this->getOrgId(),
			$this->data['cluster_id'],
			$this->data['center_id'],
			$this->data['user_role'],
			$this->data['date'],
			$this->user_id
		);

		$this->data['cluster_list'] =
			$this->getObjUserService()->fetchClustersByOrgIdAsList($this->getOrgId());

		$this->data['center_list'] = $this->getObjUserService()->fetchCentersByClusterIdAsList($this->data['cluster_list']);

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
			$this->getObjUserService()->fetchUserAbsenteesByOrgIdByClusterIdByCenterByUserRoleByDateByUserId(
				$this->getOrgId(),
				$this->data['cluster_id'],
				$this->data['center_id'],
				$this->data['user_role'],
				$this->data['date'],
				$this->user_id
			);

		$this->data['cluster_list'] =
			$this->getObjUserService()->fetchClustersByOrgIdAsList($this->getOrgId());

		$this->data['center_list'] = $this->getObjUserService()->fetchCentersByClusterIdAsList($this->data['cluster_list']);

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
