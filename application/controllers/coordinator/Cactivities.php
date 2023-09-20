<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/coordinator/Coordinator.php');

class Cactivities extends Coordinator
{
	private $org_id;
	private $cluster_id;
	private $center_id;
	private $active_center_id;
	private $user_id;
	public function __construct()
	{
		parent::__construct();
	}

	#-------------------- Student -------------------#
	public function index()
	{
		$this->data['title'] = "Student Activities Report";
		$this->data['PageTitle'] = display('student_activities_report');
		$this->data['dashboard'] = 'active';

		$this->data['activities_statistics'] = $this->ActivitiesModel->getCenterActivitiesStatusSummaryByOrgIdByClusterId( $this->getOrgId(), $this->getClusterId() );

		$this->renderView('coordinator/activities/index', $this->data);
	}

	private function loadLists()
	{
		$this->data['org_id']                   = $this->getOrgId();
		$this->data['cluster_id']               = $this->getClusterId();
		// $this->data['center_id']                = $this->getActiveCenterId();
		$this->data['user_role']                = '5';
		$this->data['cluster_list']             = $this->clusterModel->read_as_list_by_org($this->getOrgId());
		$this->data['district_list']            = getDistrictListAsArray();
	}

	function studentSessionListing($category = 'session_status', $status = '1')
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']                 = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);
		// $this->data['not_submitted_students']    = $this->getStudentsByStatus('not_submitted');
		// $this->data['pending_students']          = $this->getStudentsByStatus('pending');
		// $this->data['approved_students']         = $this->getStudentsByStatus('approved');
		$this->renderView('coordinator/activities/student_session_listing', $this->data);
	}

	public function submitForSessionApprove(): void
	{

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/index');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['session_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('approved_successfully'));
		redirect('coordinator/cactivities/index');
	}

	public function studentCncpListing($category = 'cncp_status', $status = '1'): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student CNCP Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['cncp_enrolled_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);

		$this->renderView('coordinator/activities/student_cncp_listing', $this->data);
	}
	public function submitForCncpApprove(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/studentCncpListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['cncp_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('coordinator/cactivities/studentCncpListing');
	}

	public function studentCncpSupportedListing($category = 'cncp_supported_status', $status = '1'): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student CNCP Supported Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['cncp_supported_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);

		$this->renderView('coordinator/activities/student_cncp_supported_listing', $this->data);
	}
	public function submitForCncpSupportedApprove(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/studentCncpSupportedListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['cncp_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('coordinator/cactivities/studentCncpSupportedListing');
	}

	public function studentPsychoEducatedListing($category = 'psycho_educated_status', $status = '1'): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student CNCP Supported Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['psycho_educated_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);

		$this->renderView('coordinator/activities/student_psycho_educated_listing', $this->data);
	}
	public function submitForPsychoEducatedApprove(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/studentPsychoEducatedListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['cncp_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('coordinator/cactivities/studentPsychoEducatedListing');
	}

	public function studentPrimaryCounselingListing($category = 'primary_counselling_status', $status = '1'): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student CNCP Supported Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['primary_counselling_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);

		$this->renderView('coordinator/activities/student_primary_counseling_listing', $this->data);
	}
	public function submitForPrimaryCounselingApprove(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/studentPsychoEducatedListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['cncp_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('coordinator/cactivities/studentPsychoEducatedListing');
	}

	public function studentSecondaryCounselingListing($category = 'secondary_counselling_status', $status = '1'): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student CNCP Supported Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['sec_ter_serv_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);

		$this->renderView('coordinator/activities/student_secondary_counseling_listing', $this->data);
	}
	public function submitForSecondaryCounselingApprove(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/studentSecondaryCounselingListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['secondary_counselling_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('coordinator/cactivities/studentSecondaryCounselingListing');
	}

	public function studentPsychoSocialWellBeingListing($category = 'well_being_status', $status = '1'): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student CNCP Supported Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['psycho_social_well_being_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);

		$this->renderView('coordinator/activities/student_well_being_listing', $this->data);
	}
	public function submitForPsychoSocialWellBeingApprove(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/studentSecondaryCounselingListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['well_being_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('coordinator/cactivities/studentSecondaryCounselingListing');
	}


	public function studentCarePlanListing($category = 'care_plan_status', $status = '1'): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student CNCP Supported Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['care_plans_option'] = 'active';

		$this->loadLists();
		$this->data['all_students'] = $this->ActivitiesModel->getApprovalStudentsByCategoryByOrgByClusterId($this->getOrgId(), $this->getClusterId(), $category, $status);
		$this->renderView('coordinator/activities/student_care_plan_listing', $this->data);
	}
	public function submitForCarePlanApprove(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		} else {
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('coordinator/cactivities/studentCarePlanListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['care_plan_status' => 2]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('coordinator/cactivities/studentCarePlanListing');
	}


}
