<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/OrganisationController.php');

class CAttendance extends OrganisationController
{
	private $user_id;
	private $objAttendanceFilter;
	private $objAbsenteFilter;

	public function __construct()
	{
		parent::__construct();
		$this->data['designation'] 		= $this->getObjUserService()->getUserRoleBasicAsDesignationListAsArray();
	}

	public function index()
	{
		$this->data['title']							= 'Attendance Report';
		$this->data['PageTitle']					= 'Attendance Report';
		$this->data['attendance_menu']		= 'menu-open';
		$this->data['attendance_by_rcc']	= 'active';
		$this->data['pdfFileName'] 				= 'Attendance Report of Organisation - ' . $this->data['organisation']['org_name'];

		/* ------------------ PREPARE FILTER DATA ONLY ----------------------  */
		$this->objAttendanceFilter 				= $this->getObjUserService()->getAttendanceObject();
		$this->data['filter'] 						= $this->objAttendanceFilter->toArray();

		$this->data['cluster_list'] 			= $this->getObjUserService()->fetchClustersByOrgIdAsList($this->getOrgId());
		$this->data['center_list'] 				= $this->getObjUserService()->fetchCentersByClusterIdAsList($this->data['cluster_list']);

		$this->data['content'] 						= $this->load->view('organisation/attendance/member-new', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function view($user_id)
	{
		// Set the 'id' in the $_POST array Intially
		$_POST['user_id'] = $user_id;

		$this->data['title'] 							= 'Attendance Report';
		$this->data['PageTitle']					= 'Attendance Report';
		$this->data['attendance_menu']		= 'menu-open';
		$this->data['attendance_by_rcc']	= 'active';

		/* ------------------------- Get Absentee Filter -------------------------- */
		$this->objAbsenteFilter = $this->getObjUserService()->getAbsenteeFilter();
		$this->data['absenteeFilter'] = (object) $this->objAbsenteFilter->toArray();
		/* ------------------------- Get User Log Filter -------------------------- */
		$this->data['userLog'] = $this->getObjUserService()->getUserLogsByAbsenteeFilter($this->objAbsenteFilter);

		$this->data['content'] = $this->load->view('organisation/attendance/view', $this->data, true);
		$this->load->view('organisation/starter/starter_layout', $this->data);
	}

	public function absent()
	{
		$this->data['title']						=  $this->data['PageTitle'] = 'Absentees  Report';
		$this->data['attendance_menu']	= 'menu-open';
		$this->data['absentees_report']	= 'active';
		$this->data['pdfFileName'] 			= 'Absentees Report of Organisation - ' . $this->data['organisation']['org_name'];

		$_POST['org_id']								= $this->getOrgId();
		$this->objAttendanceFilter 			= $this->getObjUserService()->getAttendanceObject();
		$this->data['filter'] 					= (object) $this->objAttendanceFilter->toArray();

		$this->data['cluster_list'] 			= $this->getObjUserService()->fetchClustersByOrgIdAsList($this->getOrgId());

		$this->data['center_list'] = $this->getObjUserService()->fetchCentersByClusterIdAsList($this->data['cluster_list']);

		$this->data['content'] = $this->load->view('organisation/attendance/absent_member-new', $this->data, true);
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
		$this->data['content'] = $this->load->view('organisation//cattendance/absent_view', $this->data, true);
		$this->load->view('organisation/layout/main_wrapper_lte', $this->data);
	}
}
