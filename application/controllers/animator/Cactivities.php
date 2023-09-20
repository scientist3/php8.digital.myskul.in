<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/animator/ActivitiesController.php');

class Cactivities extends ActivitiesController
{
	private $org_id;
	private $cluster_id;
	private $center_id;
	private $active_center_id;
	private $user_id;

	public function index()
	{
		$this->studentSessionListing();
	}
	function studentSessionListing( $category= 'session_status', $status='0,1,2' ){
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['std_sess_comp_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );

		$this->renderView('animator/activities/student_session_listing', $this->data);
	}
	// Used
	public function submitForSessionApproval(): void
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
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/index');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['session_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/index');

	}

	public function studentCncpListing($category= 'cncp_status', $status='0,1,2' ): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['cncp_enrolled_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );

		$this->renderView('animator/activities/student_cncp_listing', $this->data);
	}
	public function submitForCncpApproval(): void
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
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/studentCncpListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['cncp_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/studentCncpListing');

	}

	public function studentCncpSupportedListing($category= 'cncp_supported_status', $status='0,1,2' ): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['cncp_supported_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );

		$this->renderView('animator/activities/student_cncp_supported_listing', $this->data);
	}
	public function submitForCncpSupportedApproval(): void
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
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/studentCncpSupportedListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['cncp_supported_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/studentCncpSupportedListing');

	}

	public function studentPsychoEducatedListing($category= 'psycho_educated_status', $status='0,1,2' ): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['psycho_educated_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );

		$this->renderView('animator/activities/student_psycho_educated_listing', $this->data);
	}
	public function submitForPsychoEducatedApproval(): void
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
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/studentPsychoEducatedListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['psycho_educated_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/studentPsychoEducatedListing');

	}

	public function studentPrimaryCounsellingListing($category= 'primary_counselling_status', $status='0,1,2' ): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['primary_counselling_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );

		$this->renderView('animator/activities/student_primary_counselling_listing', $this->data);
	}
	public function submitForPrimaryCounsellingApproval(): void
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
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/studentPrimaryCounsellingListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['primary_counselling_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/studentPrimaryCounsellingListing');

	}

	public function studentSecondaryCounsellingListing($category= 'secondary_counselling_status', $status='0,1,2' ): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['sec_ter_serv_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );

		$this->renderView('animator/activities/student_secondary_counselling_listing', $this->data);
	}
	public function submitForSecondaryCounsellingApproval(): void
	{
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['psycho_social_well_being_option'] = 'active';

		if (is_array($this->input->post('students'))) {
			foreach ($this->input->post('students') as $user_id) {
				$data['students'][] = [
					'user_id' => $user_id
				];
			}
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/studentSecondaryCounsellingListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['secondary_counselling_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/studentSecondaryCounsellingListing');

	}

	public function studentPsychoSocialWellBeingListing($category= 'well_being_status', $status='0,1,2' ): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['psycho_social_well_being_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );

		$this->renderView('animator/activities/student_well_being_listing', $this->data);
	}
	public function submitPsychoSocialWellBeingApproval(): void
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
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/studentPsychoSocialWellBeingListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['well_being_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/studentPsychoSocialWellBeingListing');

	}

	public function studentCarePlanListing($category= 'care_plan_status', $status='0,1,2' ): void
	{
		$_POST['category'] = $this->category = $category;
		$_POST['status'] = $this->status = $status;
		$this->data['title'] = "Student Session Report";
		$this->data['PageTitle'] = display('list_student');
		$this->data['activities_menu'] = 'menu-open';
		$this->data['care_plans_option'] = 'active';

		$this->loadLists();
		$this->data['all_students']             = $this->getSessionStudentsByStatus( $this->category, $this->status );
		//  $this->data['not_submitted_students']   = $this->getStudentsByStatus('not_submitted');
		//  $this->data['pending_students']         = $this->getStudentsByStatus('pending');
		//  $this->data['approved_students']        = $this->getStudentsByStatus('approved');
		$this->renderView('animator/activities/student_care_plan_listing', $this->data);
	}
	public function submitCarePlanApproval(): void
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
		}else{
			$this->session->set_flashdata('exception', display('please_try_again_no_student_selected'));
			redirect('animator/cactivities/studentCarePlanListing');
		}

		$data['update'] = [
			'user_ids' => array_keys(rekeyArray('user_id', $data['students'])),
			'set' => ['care_plan_status' => 1]
		];
		$this->ActivitiesModel->updateByColumn($data['update']);
		$this->session->set_flashdata('message', display('submitted_successfully'));
		redirect('animator/cactivities/studentCarePlanListing');

	}

	public function center_by_cluster()
	{
		$cluster_idd = $this->input->post('cluster_idd');
		return $this->center_model->center_by_cluster($cluster_idd);
	}
}
