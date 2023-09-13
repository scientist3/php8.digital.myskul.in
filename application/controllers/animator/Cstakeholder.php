<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'controllers/animator/Animator.php');

class Cstakeholder extends Animator
{
	//private $organisation;
	private $user_id;
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['title'] = display('list_stakeholders');
		$this->data['PageTitle'] = display('list_stakeholders');
		$this->data['stakeholder_menu'] = 'menu-open';
		$this->data['list_stakeholders'] = 'active';

		$this->data['stakeholders'] = $this->StakeholderModel->readStakeholdersByOrgId( $this->getOrgId() );

		$this->loadCommonData();

		$this->renderView('animator/stakeholder/index', $this->data);
	}

	private function loadCommonData()
	{
		$this->data['org_id']                 = $this->getOrgId();
		$this->data['cluster_id']             = $this->getClusterId();
		$this->data['center_id']              = $this->getActiveCenterId();
		$this->data['user_role']              = '6';

		$this->data['stakeholder_type_list']  = $this->StakeholderTypeModel->get_stakeholder_as_list();
		$this->data['district_list']          = getDistrictListAsArray();
		$this->data['social_party_list']      = $this->SocialParty->social_parity_as_list();
		$this->data['cluster_list']           = $this->clusterModel->read_as_list_by_org($this->getOrgId());
	}

	public function processStakeholderForm(): void
	{
		$this->data['title']                  = display('add_student');
		$this->data['PageTitle']              = display('add_student');
		$this->data['stakeholder_menu']       = 'menu-open';
		$this->data['add_stakeholders']       = 'active';

		$this->loadCommonData();

		// Handle POST data
		$postData = $this->preparePostData();
		$this->data['stakeholder'] = (object) $postData;

		$this->setValidationRules($postData['stakeholder_type_id']);

		if ($this->form_validation->run() === true) {
			$this->handleRedirect($this->saveOrUpdateStakeholder($postData));
		} else {
			$this->renderView('animator/stakeholder/form', $this->data);
		}
	}

	private function preparePostData()
	{
		$postData = [
			'user_id'             => $this->input->post('user_id'),
			'firstname'           => $this->input->post('firstname', true),
			'village'             => $this->input->post('village', true),
			'socail_status'       => $this->input->post('socail_status', true),
			'class'               => $this->input->post('class', true),
			'date_of_joining'     => $this->input->post('date_of_joining', true),
			'group_name'          => $this->input->post('group_name', true),
			'designation'         => $this->input->post('designation', true),
			'user_role'           => '6',
			'district'            => $this->input->post('district'),
			'stakeholder_type_id' => $this->input->post('stakeholder_type_id'),
			'sex'                 => $this->input->post('sex'),
			'age'                 => $this->input->post('age'),
			'father_name'         => $this->input->post('father_name'),
			'org_idd'             => $this->getOrgId(),
			'created_by'          => $this->session->userdata('user_id'),
			'update_date'         => date('Y-m-d'),
			'status'              => 1
		];

		return $postData;
	}

	private function setValidationRules($intStackholderTypeId)
	{
		$constStakeholder = $this->StakeholderTypeModel->getStackholderTypeClass();
		// common validation for all
		$this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
		$this->form_validation->set_rules('village', display('village'), 'required');
		$this->form_validation->set_rules('age', display('age'), 'required');

		if ($intStackholderTypeId == $constStakeholder::PARENT) {
			$this->form_validation->set_rules('sex', display('gender'), 'required');
			$this->form_validation->set_rules('district', display('district'), 'required');
			$this->form_validation->set_rules('socail_status', display('socail_status'), 'required');
		} else if ($intStackholderTypeId == $constStakeholder::VOLUNTEERS) {
			$this->form_validation->set_rules('father_name', display('father_name'), 'required');
			$this->form_validation->set_rules('date_of_joining', display('date_of_joining'), 'required');
			$this->form_validation->set_rules('class', display('class'), 'required');
		} else if ($intStackholderTypeId == $constStakeholder::LOCAL_COMMUNITIES) {
			$this->form_validation->set_rules('sex', display('gender'), 'required');
			$this->form_validation->set_rules('district', display('district'), 'required');
			$this->form_validation->set_rules('socail_status', display('socail_status'), 'required');
			$this->form_validation->set_rules('designation', display('designation'), 'required');
			$this->form_validation->set_rules('group_name', display('group_name'), 'required');
		}
	}

	private function saveOrUpdateStakeholder($postData)
	{
		$stakeholder_id = $postData['user_id'];
		if (empty($stakeholder_id)) {
			if ($this->StakeholderModel->create($postData)) {
				$stakeholder_id = $this->db->insert_id();
				$this->session->set_flashdata('message', display('save_successfully'));
			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
		} else {
			if ($this->StakeholderModel->update($postData)) {
				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
		}

		return $stakeholder_id;
	}

	private function handleRedirect($stakeholderId)
	{
		if (empty($stakeholderId)) {
			redirect('animator/cstakeholder/index/');
		} else {
			redirect('animator/cstakeholder/edit/' . $stakeholderId);
		}
	}

	public function edit($stakeholder_id = ''): void
	{
		$this->data['PageTitle'] = display('edit_stakeholder');
		$this->data['hideStakeholderType'] = 'd-none';
		$this->loadCommonData();

		$this->data['stakeholder'] = $this->userModel->read_by_id($stakeholder_id);
		if (empty($this->data['stakeholder'])) {
			$this->session->set_flashdata('exception', display('no_record_found'));
			redirect('animator/cstakeholder/index');
		}
		$this->renderView('animator/stakeholder/form', $this->data);
	}
	public function delete($stakeholder_id = null)
	{
		if ($this->userModel->delete($stakeholder_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('animator/cstakeholder/');
	}

}
